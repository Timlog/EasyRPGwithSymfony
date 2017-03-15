<?php

namespace OT\CoreBundle\Controller;

use Doctrine\ORM\EntityRepository;
use OT\CoreBundle\Entity\Charac;
use OT\CoreBundle\Entity\Category;
use OT\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OT\CoreBundle\Form\CharacType;

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

    public function addAction(Request $request)
    {
        $charac = new Charac();
        $form   = $this->createForm(CharacType::class, $charac);


    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      
      $user = $this->getUser();
      $charac = $charac->setUser($user);

      $em = $this->getDoctrine()->getManager();
      $em->persist($charac);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Character saved.');
      return $this->redirectToRoute('ot_core_viewAll_characs');

    }

    return $this->render('OTCoreBundle:Charac:add.html.twig', array(
      'form' => $form->createView(),
    ));

    }

}