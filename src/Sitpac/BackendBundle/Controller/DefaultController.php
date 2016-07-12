<?php

namespace Sitpac\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function portadagAction()
	{
		$em = $this->getDoctrine()->getManager();
        $paquetesp = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetescliente('Pendiente',4);
        $paquetesa = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetescliente('Aprobado',4);
		return $this->render('BackendBundle:Gerente:portada.html.twig',array(
		'paquetesp' => $paquetesp,
		'paquetesa' => $paquetesa));
	}

	

	public function zonaadminAction()
	{
		return $this->render('BackendBundle:Default:zonaadmin.html.twig');
	}
}
