<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    /**
     * @Route("/cart", name="app.cart")
     * @Method("GET")
     * @Template()
     */
    public function cartAction(Request $request)
    {
        $cart = $this->get('app.cart_service')->getCart($request);

        return [
            'products' => $cart['products'],
            'totalsum' => $cart['totalSum']
        ];
    }

    /**
     * Shows order form.
     *
     * @Route("/orderform", name="orderform")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function orderFormAction(Request $request)
    {
        $order = new Orders();
        $form = $this->createForm('AppBundle\Form\OrderType', $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $orderSuccess = $this->get('app.order_service')->createOrderDBRecord($request, $order, $this->getUser());

            if (!$orderSuccess) {
                return $this->redirect($this->generateUrl('cartisempty')); //check valid cart
            }

            //send email notification
            /*$this->get('app.email_notifier')->handleNotification([
                'event' => 'new_order',
                'order_id' => $order->getId(),
                'admin_email' => $this->getParameter('admin_email')
            ]);*/

            return $this->render('AppBundle:Cart:thanks.html.twig'); //redirect to thankyou page
        }

        if (is_object($user = $this->getUser())) {
            $this->fillWithUserData($user, $form);
        }

        return [
            'order' => $order,
            'form' => $form->createView()
        ];
    }

    /**
     * If cart is empty.
     *
     * @Route("/cartisempty", name="cartisempty")
     * @Method("GET")
     * @Template()
     */
    public function cartIsEmptyAction()
    {
        return [];
    }

    /**
     * Count cart from cookies
     *
     * @Method("GET")
     * @Template()
     */
    public function navbarCartAction(Request $request)
    {
        $cart = $this->get('app.cart_service')->getCart($request);

        return $this->render('AppBundle:Cart:navbarCart.html.twig', [
            'cartProducts' => $cart['products'],
            'totalsum' => $cart['totalSum']
        ]);
    }

    /**
     * @param User $user
     * @param Form $form
     * @return void
     */
    private function fillWithUserData($user, $form)
    {
        $form->get('name')->setData($user->getName() . ' ' . $user->getSurname());
        $form->get('email')->setData($user->getEmail());
        //$form->get('phone')->setData($user->getPhone());
        //$form->get('address')->setData($user->getAddress());
    }
}
