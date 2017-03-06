<?php

namespace ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    /**
     * @Route("/client", name="client_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $blagues = $em->getRepository('AdminBundle:Blague')->findAll();

        return $this->render('ClientBundle:Default:index.html.twig', array(
            'blagues' => $blagues,
        ));
    }

    /**
     * @Route("/client/ajax", name="client_ajax")
     */
    public function ajaxAction()
    {
        $likes = 0;
        if (!empty($_GET['id'])) {
            $em = $this->getDoctrine()->getManager();
            $blague = $em->getRepository('AdminBundle:Blague')->find(intval(($_GET['id'])));
            $blague->setLikes($blague->getLikes() + 1);
            $em->persist($blague);
            $em->flush();

            $likes = $blague->getLikes();
        }
        return new Response($likes);
    }
}
