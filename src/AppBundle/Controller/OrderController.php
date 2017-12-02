<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class OrderController extends Controller
{
    /**
     * @Route("/order")
     */
    public function orderAction()
    {
        return $this->render('AppBundle:Order:order.html.twig', array(
            // ...
        ));
    }

}
