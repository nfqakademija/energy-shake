<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\ProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

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

    /**
     * @Route("/profile", name="app.profile")
     * @param Request $request
     * @param UserInterface $user
     * @return Response
     */
    public function editProfileAction(Request $request, UserInterface $user)
    {
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash(
                    'success',
                    $this->get('translator')->trans(
                        'message.concierge.success_event_updated',
                        ['%username%' => $user->getUsername()],
                        'user'
                    )
                );
            } catch (\Exception $exception) {
                $this->addFlash('danger', $exception->getMessage());

                return $this->redirectToRoute(
                    'app.profile'
                );
            }

        }
        return $this->render(
            'AppBundle:Profile:profile.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user
            ]
        );
    }

}
