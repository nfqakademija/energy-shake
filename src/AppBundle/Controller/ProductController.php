<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ProductController
 * @Route("product", name="app.product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="app.product_list")
     */
    public function productListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $productRepo = $em->getRepository(Product::class);
        $productList = $productRepo->getProductList();

        return $this->render('AppBundle:Product:product_list.html.twig', array(
            'list' => $productList
        ));
    }

    /**
     * @Route("/{id}", name="app.product")
     */
    public function productAction($id)
    {
        // $em = $this->getDoctrine()->getManager();
        // $productRepo = $em->getRepository(Product::class);
        // $product = $productRepo->find($id);

        $em = $this->getDoctrine()->getManager();
        $productRepo = $em->getRepository(Product::class);
        $product = $productRepo->find($id);

        return $this->render('AppBundle:Product:product.html.twig', array(
            'product' => $product
        ));
    }
}
