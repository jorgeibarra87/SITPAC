<?php

namespace Sitpac\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


class GerenteController extends Controller
{
	
	public function loginAction()
	{
		$peticion = $this->getRequest();
		$sesion = $peticion->getSession();
		$error = $peticion->attributes->get(
		SecurityContext::AUTHENTICATION_ERROR,
		$sesion->get(SecurityContext::AUTHENTICATION_ERROR)
		);
		return $this->render('BackendBundle:Gerente:login.html.twig', array(
		'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
		'error' => $error
		));
	}

}