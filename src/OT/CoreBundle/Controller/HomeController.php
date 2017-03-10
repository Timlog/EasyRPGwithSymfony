<?php

namespace OT\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('OTCoreBundle:Home:index.html.twig');
    }
}