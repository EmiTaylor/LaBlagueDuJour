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
        // connexion a la BDD et appell entity manager
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

    /**
     * @Route("/client/generer", name="client_generer")
     * Generer les blagues aleatoires
     * @return Response
     */
     public function genererBlague(): Response
     {
         $histoire =
         [
              'debut'       => ['Ecoute','Pour commencer','Il était une fois','Voila une blague','Je vais te raconter','Voila','Donc','Ok','Tu connais','C\'est la vie de','C\'est','Que','Qu\'est-ce que','Alors','Dans la mythologie','Pour toi','Connais-tu'],
              'prefixe'     => ['toutes','tous','un','une','des','les','leurs','son','elle','on','sa','ses','leurs','ton','sa','son','lui','ta','tes'],
              'sujet'       => ['victoire','dev','mon code','phrase','canard','design','Harry Potter','pc','internet','voiture','projet','groupe','portfolio','sac à main','ma femme', 'poney','moi','voiture','fille','lait','POO','mec','tramway','brigitte','abstract class','graphiste','directive de préprocesseur','au bord d\'une falaise','une chute','la gorge','un film','des bulles','chewing-gum','buisness','vacances','glacier','un ballon','les enfants','toto','un rigolo','le magicien'],
              'verbe'       => ['melanger','developper','affubler','fumer','conduir','surfer','croire','appeler','boire','coder','pousser','manger','regarder','repartir','chanter','danser','gicler','se noyer','guillotiner','eclater','fermer','rire','dessiner','casser','rougir','assoire','voyager','briser','baiser'],
              'adj'         => ['grande','abîmé','chemin','verouiller','bleu','pisse','saoulant','chauve','gluant','enervant','guitare','tres','cheveux sur la langue','gay','conne','très','rond','fortement', 'concret', 'rien','complètement seraine','taré','vieux','long'],
              'ponctu'      => ['?','!','.','...'],
         ];


        $blagues = "";

        for ($i=0; $i < 2000; $i++)
        {
            $r =    $histoire['debut']      [shuffle($histoire['debut'])]    . " " .
                    $histoire['prefixe']    [shuffle($histoire['prefixe'])]  . " " .
                    $histoire['sujet']      [shuffle($histoire['sujet'])]    . " " .
                    $histoire['verbe']      [shuffle($histoire['verbe'])]    . " " .
                    $histoire['adj']        [shuffle($histoire['adj'])]      . " " .
                    $histoire['ponctu']     [shuffle($histoire['ponctu'])];

            $blagues .= $r  . "<br>";
        }

        return new Response ($blagues);
    }

    /**
     * @Route("/client/random", name="client_random")
     * Generer les blagues aleatoires au clique sur le bouton
     * @return blague
     */

    public function randomAction(){
        $histoire =
        [
             'debut'       => ['Ok','Tu connais','C\'est la vie de','C\'est','Que','Qu\'est-ce que','Alors','Dans la mythologie','Pour toi','Connais-tu'],
             'prefixe'     => ['un','une','des','les','leurs','son','elle','on','sa','ses','leurs','ton','sa','son','lui','ta','tes'],
             'sujet'       => ['elle', 'poney','moi','voiture','fille','lait','POO','mec','tramway','brigitte','abstract class','graphiste','directive de préprocesseur','au bord d\'une falaise','une chute','la gorge','un film','des bulles','chewing-gum','buisness','vacances','glacier','un ballon','les enfants','toto','un rigolo','le magicien'],
             'verbe'       => ['croire','appeler','boire','coder','pousser','manger','regarder','repartir','chanter','danser','gicler','se noyer','guillotiner','eclater','fermer','rire','dessiner','casser','rougir','assoire','voyager','briser','baiser'],
             'adj'         => ['bleu','pisse','saoulant','chauve','gluant','enervant','guitare','tres','cheveux sur la langue','gay','conne','très','rond','fortement', 'concret', 'rien','complètement seraine','taré','vieux','long'],
             'ponctu'      => ['?','!','.','...'],
        ];
        $r =    $histoire['debut']      [shuffle($histoire['debut'])]    . " " .
                $histoire['prefixe']    [shuffle($histoire['prefixe'])]  . " " .
                $histoire['sujet']      [shuffle($histoire['sujet'])]    . " " .
                $histoire['verbe']      [shuffle($histoire['verbe'])]    . " " .
                $histoire['adj']        [shuffle($histoire['adj'])]      . " " .
                $histoire['ponctu']     [shuffle($histoire['ponctu'])];

        return new Response ($r);
    }
}
