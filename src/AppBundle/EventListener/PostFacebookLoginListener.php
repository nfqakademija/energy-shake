<?php
/**
 * Created by PhpStorm.
 * User: tmotuzis
 * Date: 17.11.5
 * Time: 15.43
 */

namespace AppBundle\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;

class PostFacebookLoginListener
{
    private $clientRegistry;

    public function __construct(ClientRegistry $clientRegistry){
        $this->clientRegistry = $clientRegistry;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        //$registry = $this->get('oauth2.registry');
        //dump($user);
       // die;
    }
}