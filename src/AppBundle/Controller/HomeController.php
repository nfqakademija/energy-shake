<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @Route("/")
 * @Route("/{_locale}", defaults={"_locale": "lt"}, requirements={"_locale" = "%app.locales%"})
 */

class HomeController extends Controller
{

    /**
     * @Route("/", name="app.home")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $list = $this->get('app.cart_service')->getCartProducts($request);
        return $this->render('AppBundle:Home:index.html.twig', [
            'list' => $list
        ]);
    }
}
