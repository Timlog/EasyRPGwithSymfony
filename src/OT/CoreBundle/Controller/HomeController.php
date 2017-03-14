<?php

namespace OT\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
    	$user = $this->getUser();

    	if($user === null)
    	{
    		return $this->redirectToRoute('fos_user_security_login');
    	}

        return $this->redirectToRoute('ot_core_viewAll_characs');
    }
}