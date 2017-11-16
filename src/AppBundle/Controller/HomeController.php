<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
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
     */
    public function indexAction()
    {
        // $foo = $this->get('AppBundle/Service/Foo');
        // $trans = $this->get('translator');
        //$translated = $this->get('translator')->trans('testing');
        //return new Response($translated);
        return $this->render('AppBundle:Home:index.html.twig', []);

    }
}
