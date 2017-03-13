<?php

namespace OT\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OTUserBundle:Default:index.html.twig');
    }
}
