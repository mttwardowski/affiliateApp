<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MarketplaceController extends Controller
{

    /**
     *
     * @Route("/category/{category_id}", name="category")
     */
    public function categoryProductsAction($category_id) {
        $category = $this->getDoctrine()->getRepository('AppBundle:Categories')->find($category_id);
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAllByCategory($category);

        return $this->render(':Marketplace:category_products.html.twig', array(
            'products' => $products,
            'category' => $category
        ));
    }


    /**
     * @Route("/top_sellers", name="top_sellers")
     */
    public function topSellerProductsAction() {
        $top_products = $this->getDoctrine()->getRepository('AppBundle:Product')->findByMostSales();

        return $this->render(':Marketplace:top_sellers.html.twig', array(
            'top_products' => $top_products
        ));
    }
}
