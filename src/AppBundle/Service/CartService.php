<?php

namespace AppBundle\Service;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class CartService
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
     * @param Request $request
     * @return array
     */
    public function getCart(Request $request)
    {
        $productRepository = $this->em->getRepository('AppBundle:Product');
        $productsArray = [];
        $cart = [];
        $totalSum = 0;
        $cookies = $request->cookies->all();
        if (isset($cookies['cart'])) {
            $cart = json_decode($cookies['cart']);
        }
        foreach ($cart as $productId => $productQuantity) {
            /**
             * @var Product $product
             */
            $product = $productRepository->find((int)$productId);
            if (is_object($product)) {
                $productPosition = [];
                $quantity = abs((int)$productQuantity);
                $price = $product->getPrice();
                $sum = $price * $quantity;
                $productPosition['product'] = $product;
                $productPosition['quantity'] = $quantity;
                $productPosition['price'] = $price;
                $productPosition['sum'] = $sum;
                $totalSum += $sum;
                $productsArray[] = $productPosition;
            }
        }
        $data = ["totalSum" => $totalSum, "products" => $productsArray];

        return $data;
    }

    public function getCartProducts(Request $request)
    {
        $cart = [];
        $cartArray = [];
        $list = $this->em->getRepository('AppBundle:Product')
            ->getProductList();
        $cookies = $request->cookies->all();
        if (isset($cookies['cart'])) {
            $cart = json_decode($cookies['cart']);
        }

        foreach ($cart as $productId => $productQuantity) {
            $cartArray[] = ["productId" => $productId, "productQuantity" => $productQuantity];
        }
        foreach ($list as $product) {
            /**
             * @var Product $product
             */
            $inCart = $this->searcharray($product->getId(), 'productId', $cartArray);
            if ($inCart['productQuantity'] != null ){
                $product->cartQuantity = $inCart['productQuantity'];
            } else {
                $product->cartQuantity = 0;
            }
        }

        return $list;
    }

    private function searcharray($value, $key, $array) {

        foreach ($array as $k => $val) {
            if ($val[$key] == $value) {
                return $val;
            }
        }
        return null;
    }
}