<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @Route("product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="app.product")
     */
    public function indexAction(Request $reguest)
    {
       // $em = $this->getDoctrine()->getManager();
       // $productRepo = $em->getRepository(Product::class);
       // $product = $productRepo->find($id);

        return $this->render('AppBundle:Product:index.html.twig', array(
            // ...
        ));
    }

}
