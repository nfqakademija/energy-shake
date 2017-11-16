<?php
/**
 * Created by PhpStorm.
 * User: tmotuzis
 * Date: 17.11.5
 * Time: 15.43
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;

class PostFacebookLoginListener
{
    private $clientRegistry;
    private $em;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
    }
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken()->getUser()->getFbToken();
        $client = $this->clientRegistry->getClient('facebook_main');
        $provider = $client->getOAuth2Provider();
        $fbToken = $provider->getLongLivedAccessToken($token);
        $facebookUser = $client->fetchUserFromToken($fbToken);
        $user = $this->em->getRepository(User::class)
            ->findOneBy(['facebookId' => $facebookUser->getId()]);
        // check if no exist
        if(!$user->getImage() ){
            $user->setImage($facebookUser->getPictureUrl());
            $this->em->flush();
        }
    }
}