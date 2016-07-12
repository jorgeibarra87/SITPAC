<?php

namespace Sitpac\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	public function ayudaAction()
	{
		return $this->render('FrontendBundle:Default:ayuda.html.twig');
	}

	public function portadaAction()
	{
		return $this->render('FrontendBundle:Default:portada.html.twig');
	}

	
}