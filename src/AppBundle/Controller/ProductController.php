<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AffiliateRequests;
use AppBundle\Entity\Product;
use AppBundle\Form\AddProductFormType;
use AppBundle\Form\AffiliateRequestFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    /**
     * @Route("/product/{product_id}", name="product")
     */
    public function productPageAction($product_id, Request $request) {
        $user = $this->getUser();
        $product = $this->getDoctrine()->getRepository("AppBundle:Product")->find($product_id);

        //Checks to see if product exists
        if ( $product == null) {
            return $this->redirectToRoute('access_denied');
        }

        //Checks to see if product is already requested
        $alreadyRequested = $this->getDoctrine()->getRepository('AppBundle:AffiliateRequests')->isAlreadyRequested($user, $product);
        $affiliateRequest = new AffiliateRequests($user, $product);
        $affiliateRequestForm = $this->createForm(AffiliateRequestFormType::class, $affiliateRequest);

        //If not already requested create Form
        if (!$alreadyRequested) {
            $affiliateRequestForm->handleRequest($request);

            if ($affiliateRequestForm->isSubmitted() && $affiliateRequestForm->isValid()) {
                $affiliateRequest->setMessage($affiliateRequestForm['message']->getData());

                $db_manager = $this->getDoctrine()->getManager();
                $db_manager->persist($affiliateRequest);
                $db_manager->flush();
                $db_manager->clear();

                $this->addFlash(
                    'notice',
                    'Product Requested'
                );

                return $this->redirect($this->generateUrl('product', array('product_id' => $product_id)));
            }
        }

        return $this->render(':Product:product_page.html.twig', array(
            'product' => $product,
            'affiliateRequestForm' => $affiliateRequestForm->createView(),
            'alreadyRequested' => $alreadyRequested
        ));
    }

    /**
     * @Route("/my_products", name="my_products")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function myProductsAction()
    {
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAllByUser($this->getUser());

        return $this->render(':Product:all_my_products.html.twig', array(
            'products' => $products
        ));
    }

    /**
     * @Route("/add_product", name="add_product")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addProductAction(Request $request)
    {
        $product = new Product();
        $user = $this->getUser();
        $basic_info_form = $this->createForm(AddProductFormType::class, $product);

        $basic_info_form->handleRequest($request);

        if ($basic_info_form->isSubmitted() && $basic_info_form->isValid()) {

            $product->setAllowSales($basic_info_form['allow_sales']->getData());
            $product->setMarketplaceShow($basic_info_form['allow_sales']->getData());
            $product->setName($basic_info_form['name']->getData());
            $product->setCurrency($basic_info_form['currency']->getData());
            $product->setPrice($basic_info_form['price']->getData());
            $product->setCommission($basic_info_form['commission']->getData());
            $product->setSupportEmail($basic_info_form['supportEmail']->getData());
            $product->setSupportURL($basic_info_form['supportURL']->getData());
            $product->setPageURL($basic_info_form['pageURL']->getData());
            $product->setReturnPeriodNumber($basic_info_form['returnPeriodNumber']->getData());
            $product->setReturnPeriodUnit($basic_info_form['returnPeriodUnit']->getData());
            $product->setAffiliateApproval($basic_info_form['affiliateApproval']->getData());
            if ($basic_info_form['description']->getData() != null) {
                $product->setDescription($basic_info_form['description']->getData());
            }
            if ($basic_info_form['keywords']->getData() != null) {
                $product->setDescription($basic_info_form['keywords']->getData());
            }

            $product->setUser($user);

            $db_manager = $this->getDoctrine()->getManager();
            $db_manager->persist($product);
            $db_manager->flush();
            $db_manager->clear();

            $this->addFlash(
                'notice',
                'Product Added'
            );

            return $this->redirectToRoute('add_product');

        }

        return $this->render(':Product:add_product.html.twig', array(
            'basic_info_form' => $basic_info_form->createView()
        ));
    }

    /**
     * @Route("/edit_product/{product_id}", name="edit_product")
     * @param $product_id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editProductAction($product_id, Request $request) {
        $product = $this->getDoctrine()->getRepository("AppBundle:Product")->find($product_id);
        $user = $this->getUser();

        if ( $product == null || ($product->getUser() != $user)) {
            return $this->redirectToRoute('access_denied');
        }

        $form = $this->createForm(AddProductFormType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setAllowSales($form['allow_sales']->getData());
            $product->setMarketplaceShow($form['allow_sales']->getData());
            $product->setName($form['name']->getData());
            $product->setCurrency($form['currency']->getData());
            $product->setPrice($form['price']->getData());
            $product->setCommission($form['commission']->getData());
            $product->setSupportEmail($form['supportEmail']->getData());
            $product->setSupportURL($form['supportURL']->getData());
            $product->setPageURL($form['pageURL']->getData());
            $product->setReturnPeriodNumber($form['returnPeriodNumber']->getData());
            $product->setReturnPeriodUnit($form['returnPeriodUnit']->getData());
            $product->setAffiliateApproval($form['affiliateApproval']->getData());
            if ($form['description']->getData() != null) {
                $product->setDescription($form['description']->getData());
            }
            if ($form['keywords']->getData() != null) {
                $product->setKey($form['keywords']->getData());
            }

            $product->setUser($user);

            $db_manager = $this->getDoctrine()->getManager();
            $db_manager->persist($product);
            $db_manager->flush();
            $db_manager->clear();

            $this->addFlash(
                'notice',
                'Product Added'
            );

            return $this->redirectToRoute('my_products');
        }

        return $this->render(':Product:edit_product.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     *
     * @Route("/active_products", name="active_products")
     * @return Response
     */
    public function activeProducts() {
        $user = $this->getUser();
        $affiliateRequests = $this->getDoctrine()->getRepository('AppBundle:AffiliateRequests')->findBy(array('user' => $user));

        return $this->render(':Affiliate:products_active.html.twig', array(
            'affiliateRequests' => $affiliateRequests
        ));
    }

    /**
     *
     * @Route("/pending_products", name="pending_products")
     * @return Response
     */
    public function pendingProducts() {
        $user = $this->getUser();
        $affiliateRequests = $this->getDoctrine()->getRepository('AppBundle:AffiliateRequests')->findBy(array('user' => $user));

        return $this->render(':Affiliate:products_pending.html.twig', array(
            'affiliateRequests' => $affiliateRequests
        ));
    }

    /**
     *
     * @Route("/inactive_products", name="inactive_products")
     * @return Response
     */
    public function inactiveProducts() {
        $user = $this->getUser();
        $affiliateRequests = $this->getDoctrine()->getRepository('AppBundle:AffiliateRequests')->findBy(array('user' => $user));

        return $this->render(':Affiliate:products_inactive.html.twig', array(
            'affiliateRequests' => $affiliateRequests
        ));
    }

    /**
     * This method is to be used with AJAX to remove a product dynamically
     *
     * @Route("/delete_product/{product_id}", name="delete_product")
     * @param $product_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteProduct($product_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('AppBundle:Product')->find($product_id);

        if (!$product) {
            $response = array("product" => "NONE", "success" => false);
            return new Response(json_encode($response));
        }

        $em->remove($product);
        $em->flush();

        $response = array("product" => $product->getName(), "success" => true);

        return new Response(json_encode($response));
    }




}
