<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sale;
use AppBundle\Form\SaleFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{

    /**
     *
     * This handles the invoice/purchase of the product
     *
     * @Route("/invoice/{affiliate_request_id}", name="invoice")
     * @param $affiliate_request_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function invoiceAction($affiliate_request_id, Request $request) {
        $affiliate_request = $this->getDoctrine()->getRepository('AppBundle:AffiliateRequests')->find($affiliate_request_id);
        $product = $affiliate_request->getProduct();
        $affiliate = $affiliate_request->getUser();
        $product_owner = $product->getUser();
        $sale = new Sale($affiliate, $product);

        $sale_form = $this->createForm(SaleFormType::class, $sale);

        $sale_form->handleRequest($request);

        if ($sale_form->isSubmitted() && $sale_form->isValid()) {

            //Increment Sales of each Entity
            $affiliate_request->incrementSales();
            $product_owner->incrementSales();
            $affiliate->incrementSales();
            $product->incrementSales();

            //Calculate Cuts
            $site_cut = ($product->getPrice() * 0.01);
            $affiliate_cut = (($product->getPrice() - $site_cut) * ($product->getCommission() / 100));
            $product_owner_cut = (($product->getPrice() - $site_cut) - $affiliate_cut);

            //Increment Earnings
            $product_owner->incrementEarnings($product_owner_cut);
            $affiliate->incrementEarnings($affiliate_cut);
            $affiliate_request->incrementEarnings($affiliate_cut);

            $sale->setFirstName($sale_form['firstName']->getData());
            $sale->setLastName($sale_form['lastName']->getData());
            $sale->setAddress($sale_form['address']->getData());
            $sale->setPrice($product->getPrice());
            $sale->setQuantity(1); //Change to dynamic later
            $sale->setOrderID("1245523532"); //Change this uniqueID later


            $db_manager = $this->getDoctrine()->getManager();

            $db_manager->persist($product);
            $db_manager->flush();

            $db_manager->persist($affiliate);
            $db_manager->flush();

            $db_manager->persist($affiliate_request);
            $db_manager->flush();

            $db_manager->persist($product_owner);
            $db_manager->flush();

            $db_manager->persist($sale);
            $db_manager->flush();
            $db_manager->clear();

            return $this->redirectToRoute('thank_you', array('affiliate_id' => $affiliate_request->getId()) );

        }


        return $this->render(':Payment:invoice.html.twig', array(
            'product' => $product,
            'sale_form' => $sale_form->createView()
        ));
    }


    /**
     *
     * @Route("/thank_you/{affiliate_id}", name="thank_you")
     * @param $affiliate_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function thankYouAction($affiliate_id) {
        $affiliate_request = $this->getDoctrine()->getRepository('AppBundle:AffiliateRequests')->find($affiliate_id);
        $product = $affiliate_request->getProduct();

        return $this->render(':Payment:thank_you.html.twig', array(
            'product' => $product
        ));
    }

}
