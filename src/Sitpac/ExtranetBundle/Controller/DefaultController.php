<?php

namespace Sitpac\ExtranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    

    public function portadaoAction()
	{
		return $this->render('ExtranetBundle:Operador:portada.html.twig');
	}
	
	
}
