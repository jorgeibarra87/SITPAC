<?php

namespace Sitpac\ExtranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Sitpac\ExtranetBundle\Entity\Proveedor;
use Sitpac\ExtranetBundle\Form\ProveedorType;
use Sitpac\ExtranetBundle\Form\perfilpType;

use Sitpac\ExtranetBundle\Entity\Solicitudes;
use Sitpac\ExtranetBundle\Form\SolicitudType;

class ProveedorController extends Controller
{
	
	public function loginAction()
	{
		$peticion = $this->getRequest();
		$sesion = $peticion->getSession();
		$error = $peticion->attributes->get(
		SecurityContext::AUTHENTICATION_ERROR,
		$sesion->get(SecurityContext::AUTHENTICATION_ERROR)
		);
		return $this->render('ExtranetBundle:Proveedor:login.html.twig', array(
		'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
		'error' => $error
		));
	}


	public function registroAction()
	{

		$peticion = $this->getRequest();
		$proveedor = new Proveedor();
		$formulario = $this->createForm(new ProveedorType(), $proveedor);
		
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			
			if ($formulario->isValid()) {

				$clave = $formulario->getData()->getPassword();
				$encoder = $this->get('security.encoder_factory')->getEncoder($proveedor);
				$proveedor->setSalt(md5(time()));
				$passwordCodificado = $encoder->encodePassword(
				$proveedor->getPassword(),
				$proveedor->getSalt()
				);
				$proveedor->setPassword($passwordCodificado);
				$proveedor->subirArchivo();
				
				$nombre = $formulario->getData()->getNombres() .' '. $formulario->getData()->getApellidos();
				$email = $formulario->getData()->getEmail();
				

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($proveedor);
				$em->flush();

				$message = \Swift_Message::newInstance()
		        ->setSubject('SITPAC Solicitud Registro Proveedor')
		        ->setFrom('send@example.com')
		        ->setTo('recipient@example.com')
		        ->setBody( $this->renderView('ExtranetBundle:Proveedor:emailRegistro.html.twig', array('nombre' => $nombre,
				'email' => $email,
				'clave' => $clave)), 'text/html');
		        /*->addPart('
		        <img src="http://localhost/sitpac/web/bundles/frontend/img/logo.jpg" alt="imagen">
		        <h1>SITPAC solicitud de registro enviada por:</h1>
               	<p>Nombre: '.$nombre.'</p>
               	<p>Email: '.$email.'</p>
               	<p>Su solicitud esta en estudio, se le notificara a este correo su aprobacion.</p>
               	<p><h6>mensaje enviado por SITPAC (Sistema de informacion turistica de paquetes del cauca)</p>', 'text/html');*/

    			$this->get('mailer')->send($message);

				$this->get('session')->setFlash('info', 'Tu solicitud sera estudiada y se confirmara en tu correo su aprobacion o rechazo');
				return $this->redirect($this->generateUrl('portada'));

			}
        }

		return $this->render('ExtranetBundle:Proveedor:registro.html.twig', array('formulario' => $formulario->createView()));		
        		

	}



	public function perfilAction()
	{
		$proveedor = $this->get('security.context')->getToken()->getUser();
		$formulario = $this->createForm(new PerfilpType(), $proveedor);

		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$docOriginal = $formulario->getData()->getDocumentos();
			$passwordOriginal = $formulario->getData()->getPassword();

			$formulario->bind($peticion);
				if ($formulario->isValid()) {
					if (null == $proveedor->getDocumentos()) {
					// el doc original no se modifica, recuperar su ruta
					$proveedor->setDocumentos($docOriginal);
				}

				if (null == $proveedor->getPassword()) {
					$proveedor->setPassword($passwordOriginal);
				}
				else {
					$encoder = $this->get('security.encoder_factory')
					->getEncoder($proveedor);
					$passwordCodificado = $encoder->encodePassword(
					$proveedor->getPassword(),
					$proveedor->getSalt());
					$proveedor->setPassword($passwordCodificado);
				}
			// actualizar el perfil del usuario
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($proveedor);
				$em->flush();
				$this->get('session')->setFlash('info', 'Los datos de tu perfil se han actualizado correctamente');
				return $this->redirect($this->generateUrl('proveedor_perfil'));
			}
		}

		return $this->render('ExtranetBundle:Proveedor:perfil.html.twig', array(
		'proveedor' => $proveedor,
		'formulario' => $formulario->createView()
		));
	}


	public function retirarAction()
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		$proveedor = $this->get('security.context')->getToken()->getUser();

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($idproveedor);
				$solicitud->setNomelemento($nomproveedor);
				$solicitud->setSolicitud('Solicitud retiro proveedor');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de retiro de proveedor se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Proveedor:solicitudRetiroProveedor.html.twig', array(
		'formulario' => $formulario->createView(),
		'proveedor' => $proveedor)); 	
	}

	public function reservasserviciosAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$proveedor = $this->get('security.context')->getToken()->getUser();
		$idproveedor = $proveedor->getIdproveedor();
		$reservas = $em->getRepository('FrontendBundle:Reserva')->findreservasservicios($idproveedor, 'En Reserva');

		$paginator  = $this->get('knp_paginator');
		$pagreservas = $paginator->paginate( $reservas, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Proveedor:reservasservicios.html.twig',array('reservas' => $reservas,
		'pagreservas' => $pagreservas,));
	}

	public function detallesreservaserviciosAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$reserva = $em->getRepository('FrontendBundle:Reserva')->find($id);
		$intinerario = $em->getRepository('FrontendBundle:Reserva')->findIntinerarioreserva($id);

		return $this->render('ExtranetBundle:Proveedor:detallesreservaservicios.html.twig',array('reserva' => $reserva,
		'intinerario' => $intinerario,));
		
	}

	public function ventasserviciosAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$proveedor = $this->get('security.context')->getToken()->getUser();
		$idproveedor = $proveedor->getIdproveedor();
		$reservas = $em->getRepository('FrontendBundle:Reserva')->findreservasservicios($idproveedor, 'Pagada');

		$paginator  = $this->get('knp_paginator');
		$pagreservas = $paginator->paginate( $reservas, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Proveedor:ventasservicios.html.twig',array('reservas' => $reservas,
		'pagreservas' => $pagreservas,));
	}

	public function detallesventasserviciosAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$reserva = $em->getRepository('FrontendBundle:Reserva')->find($id);
		$intinerario = $em->getRepository('FrontendBundle:Reserva')->findIntinerarioreserva($id);

		return $this->render('ExtranetBundle:Proveedor:detallesventasservicios.html.twig',array('reserva' => $reserva,
		'intinerario' => $intinerario,));
		
	}


}