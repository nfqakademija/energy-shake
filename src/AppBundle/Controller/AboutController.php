<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AboutController extends Controller
{
    /**
     * @Route("/about", name="app.about")
     */
    public function aboutAction()
    {
        return $this->render('AppBundle:About:about.html.twig', array(
            // ...
        ));
    }

}
