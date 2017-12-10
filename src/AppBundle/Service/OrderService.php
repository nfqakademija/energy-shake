<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\OrderDetails;
use AppBundle\Entity\Orders;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    /**
     * @var EntityManager $em
     */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Record cart to db order.
     *
     * @param Request $request
     * @param Orders $order
     * @param User $user
     * @return bool
     */
    public function createOrderDBRecord(Request $request, Orders $order, User $user = null)
    {
        $productRepository = $this->em->getRepository('AppBundle:Product');

        $cart = $this->getCartFromCookies($request);
        if ((!$cart) || !(count($cart))) {
            return false;
        }

        //parse cart json form cookies
        $sum = 0; //total control sum of the order
        foreach ($cart as $productId => $productQuantity) {
            $product = $productRepository->find((int)$productId);
            if (is_object($product)) {
                $quantity = abs((int)$productQuantity);
                $sum += ($quantity * $product->getPrice());

                $orderProduct = new OrderDetails();
                $orderProduct->setOrder($order);
                $orderProduct->setProduct($product);
                $orderProduct->setPrice($product->getPrice());
                $orderProduct->setQuantity($quantity);
                $this->em->persist($orderProduct);

                $order->addOrderProduct($orderProduct);
            }
        }

        $order->setUser($user); //can be null if not registered
        $order->setSum($sum);
        $this->em->persist($order);
        $this->em->flush();

        $this->clearCart();
        return true;
    }

    /**
     * Get cart from cookies and return cart or false.
     *
     * @param Request $request
     * @return mixed
     */
    private function getCartFromCookies(Request $request)
    {
        $cookies = $request->cookies->all();

        if (isset($cookies['cart'])) {
            $cart = json_decode($cookies['cart']);

            $cartObj = $cart; //check if cart not empty
            if (!empty($cartObj) && count((array)$cartObj)) {
                return $cart;
            }
        }

        return false;
    }

    /**
     * clear cookies cart
     *
     * @return void
     */
    public function clearCart()
    {
        $response = new Response();
        $response->headers->clearCookie('cart');
        $response->sendHeaders();
    }
}
