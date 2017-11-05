<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @Route("product", name="app.product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="app.product")
     */
    public function productAction(Request $reguest)
    {
       // $em = $this->getDoctrine()->getManager();
       // $productRepo = $em->getRepository(Product::class);
       // $product = $productRepo->find($id);

        return $this->render('AppBundle:Product:product.html.twig', array(
            // ...
        ));
    }

}
