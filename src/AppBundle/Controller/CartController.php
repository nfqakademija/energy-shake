<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CartController extends Controller
{
    /**
     * @Route("/cart", name="app.cart")
     */
    public function cartAction()
    {
        return $this->render('AppBundle:Cart:cart.html.twig', array(
            // ...
        ));
    }

}
