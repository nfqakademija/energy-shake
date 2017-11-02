<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUserName();
        return $this->render('AppBundle:Login:login.html.twig', array(
            'errors' => $errors,
            'username' => $lastUserName,
        ));
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(){

    }

}
