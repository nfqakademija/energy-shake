<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class HomeController
 * @Route("/")
 */

class HomeController extends Controller
{

    /**
     * @Route("/", name="app.home")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Home:index.html.twig', []);

    }
}
