<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('Dashboard/dashboard.html.twig');
    }
    
    public function showSideNavAction() {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Categories')->findAll();

        return $this->render(':BaseComponents:side_nav.html.twig', array(
           'categories' => $categories
        ));
    }
}
