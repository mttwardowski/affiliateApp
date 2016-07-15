<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AffiliateRequests;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AffiliateController extends Controller
{

    /**
     * @Route("/my_affiliates", name="my_affiliates")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function myAffiliatesAction() {
        $user = $this->getUser();
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAllByUser($user);

        return $this->render(':Affiliate:my_affiliates.html.twig', array(
            'products' => $products
        ));
    }


    /**
     * This method is to be used with AJAX to request affiliate approval of a product dynamically
     *
     * @Route("/request_approval/{product_id}/{message}", name="request_approval")
     * @param $product_id
     * @param $message
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function requestAffiliateApproval($product_id, $message) {
        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($product_id);

        if (!$product) {
            $response = array("product" => "NONE", "success" => false);
            return new Response(json_encode($response));
        }

        $affiliateRequest = new AffiliateRequests($this->getUser(), $product);
        $affiliateRequest->setMessage($message);

        $db_manager = $this->getDoctrine()->getManager();
        $db_manager->persist($affiliateRequest);
        $db_manager->flush();
        $db_manager->clear();

        $response = array("product" => $product->getName(), "success" => true);

        return new Response(json_encode($response));
    }

    /**
     *  Used with AJAX to accept affiliate request of a product dynamically
     *
     * @Route("/accept_request/{request_id}", name="accept_request")
     * @param $request_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function acceptAffiliateRequest($request_id) {
        //Get the affiliate request entity
        $affiliate_request = $this->getDoctrine()->getRepository('AppBundle:AffiliateRequests')->find($request_id);
        $product = $affiliate_request->getProduct();

        //If no affiliate_request found, return error response
        if (!$affiliate_request) {
            $response = array("product" => "NONE", "success" => false);
            return new Response(json_encode($response));
        }

        //Set the status of request to accepted
        $affiliate_request->setStatus(AffiliateRequests::$REQUEST_ACCEPTED);

        //Increment number of affiliates on Product
        $product->incrementNumberAffiliates();

        //Persist changes into DB
        $db_manager = $this->getDoctrine()->getManager();

        $db_manager->persist($affiliate_request);
        $db_manager->flush();

        $db_manager->persist($product);
        $db_manager->flush();
        $db_manager->clear();

        $response = array("product" => $affiliate_request->getProduct()->getName(), "success" => true);
        return new Response(json_encode($response));

    }

    /**
     *  Used with AJAX to deny affiliate request of a product dynamically
     *
     * @Route("/deny_request/{request_id}", name="deny_request")
     * @param $request_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function denyAffiliateRequest($request_id) {
        //Get the affiliate request entity
        $affiliate_request = $this->getDoctrine()->getRepository('AppBundle:AffiliateRequests')->find($request_id);

        //If no affiliate_request found, return error response
        if (!$affiliate_request) {
            $response = array("product" => "NONE", "success" => false);
            return new Response(json_encode($response));
        }

        //Set the status of request to denied
        $affiliate_request->setStatus(AffiliateRequests::$REQUEST_DENIED);

        //Persist changes into DB
        $db_manager = $this->getDoctrine()->getManager();
        $db_manager->persist($affiliate_request);
        $db_manager->flush();
        $db_manager->clear();

        $response = array("product" => $affiliate_request->getProduct()->getName(), "success" => true);
        return new Response(json_encode($response));

    }



}
