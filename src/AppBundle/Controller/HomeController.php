<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Product;

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
        $em = $this->getDoctrine()->getManager();
        $productRepo = $em->getRepository(Product::class);
        $productList = $productRepo->getProductList();
        return $this->render('AppBundle:Home:index.html.twig', [
            'list' => $productList
        ]);
    }
}
