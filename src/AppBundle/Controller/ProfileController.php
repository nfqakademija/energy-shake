<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="app.profile")
     */
    public function profileAction()
    {
        return $this->render('AppBundle:Profile:profile.html.twig', array(
            // ...
        ));
    }

}
