<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ErrorController extends Controller
{
    /**
     * @Route("/access_denied", name="access_denied")
     */
    public function indexAction()
    {

        return $this->render(':Error:access_not_allowed.html.twig');
    }

}
