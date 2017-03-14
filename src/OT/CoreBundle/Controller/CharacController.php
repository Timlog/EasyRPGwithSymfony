<?php

namespace OT\CoreBundle\Controller;

use Doctrine\ORM\EntityRepository;
use OT\CoreBundle\Entity\Charac;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CharacController extends Controller
{

   public function viewAllAction()
    {
    	$user = $this->getUser();

    	$repository = $this
    		->getDoctrine()
    		->getManager()
    		->getRepository('OTCoreBundle:Charac')
    	;

    	$listCharacs = $repository->findByUser($user);

    	return $this->render('OTCoreBundle:Charac:view_all.html.twig', array(
    		'listCharacs' => $listCharacs
    		));

    }
    public function viewAction($id)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('OTCoreBundle:Charac')
        ;

        $charac = $repository->find($id);

        return $this->render('OTCoreBundle:Charac:view.html.twig', array(
            'charac' => $charac
            ));

    }
}