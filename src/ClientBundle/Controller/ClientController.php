<?php

namespace ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ClientController extends Controller
{
    /**
     * @Route("/client/client")
     */
    public function indexAction()
    {
        return $this->render('ClientBundle:Default:index.html.twig');
    }
}
