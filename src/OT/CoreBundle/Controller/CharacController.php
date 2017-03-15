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
      $charac->setUser($user);

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

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $charac = $em->getRepository('OTCoreBundle:Charac')->find($id);

    if (null === $charac) {
      throw new NotFoundHttpException("Character with id= ".$id." doesn't exist.");
    }
    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
      $em->remove($charac);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "The character has been deleted.");
      return $this->redirectToRoute('ot_core_viewAll_characs');
    }

    return $this->render('OTCoreBundle:Charac:delete.html.twig', array(
      'charac' => $charac,
      'form'   => $form->createView(),
    ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $charac = $em->getRepository('OTCoreBundle:Charac')->find($id);
        $form = $this->createForm(CharacType::class, $charac);

    if (null === $charac) {
      throw new NotFoundHttpException("Character with id= ".$id." doesn't exist.");
    }

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
      $em->flush();
      $request->getSession()->getFlashBag()->add('info', "The character has been edited.");
      return $this->redirectToRoute('ot_core_viewAll_characs');
    }

    return $this->render('OTCoreBundle:Charac:edit.html.twig', array(
      'charac' => $charac,
      'form'   => $form->createView(),
    ));
    }

}