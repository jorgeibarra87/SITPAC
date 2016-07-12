<?php

namespace Sitpac\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Sitpac\FrontendBundle\Entity\Cliente;
use Sitpac\FrontendBundle\Form\ClienteType;
use Sitpac\FrontendBundle\Form\perfilType;

use Sitpac\FrontendBundle\Entity\PaqueteTuristico;
use Sitpac\ExtranetBundle\Form\PaqueteTuristicocType;
use Sitpac\ExtranetBundle\Form\BusquedaPaquetesType;

use Sitpac\FrontendBundle\Entity\ServicioPaqAlo;
use Sitpac\FrontendBundle\Form\ServicioPaqAlocType;

use Sitpac\FrontendBundle\Entity\ServicioPaqAlim;
use Sitpac\FrontendBundle\Form\ServicioPaqAlimcType;

use Sitpac\FrontendBundle\Entity\ServicioPaqExcu;
use Sitpac\FrontendBundle\Form\ServicioPaqExcucType;

use Sitpac\FrontendBundle\Entity\ServicioPaqVehi;
use Sitpac\FrontendBundle\Form\ServicioPaqVehicType;

use Sitpac\FrontendBundle\Entity\ServicioPaqVuel;
use Sitpac\FrontendBundle\Form\ServicioPaqVuelcType;

use Sitpac\FrontendBundle\Entity\Reserva;
use Sitpac\FrontendBundle\Form\ReservaType;

use Sitpac\FrontendBundle\Entity\IntinerarioReserva;
use Sitpac\FrontendBundle\Form\IntinerarioReservaType;

use Sitpac\FrontendBundle\Entity\Pqr;
use Sitpac\FrontendBundle\Form\PqrType;


class ClienteController extends Controller
{
	
	public function loginAction()
	{
		$peticion = $this->getRequest();
		$sesion = $peticion->getSession();
		$error = $peticion->attributes->get(
		SecurityContext::AUTHENTICATION_ERROR,
		$sesion->get(SecurityContext::AUTHENTICATION_ERROR)
		);
		return $this->render('FrontendBundle:Cliente:login.html.twig', array(
		'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
		'error' => $error
		));
	}


	public function registroAction()
	{

		$peticion = $this->getRequest();
		$cliente = new Cliente();
		$formulario = $this->createForm(new ClienteType(), $cliente);
		
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			
			if ($formulario->isValid()) {


				$encoder = $this->get('security.encoder_factory')->getEncoder($cliente);
				$cliente->setSalt(md5(time()));
				$passwordCodificado = $encoder->encodePassword(
				$cliente->getPassword(),
				$cliente->getSalt()
				);
				$cliente->setPassword($passwordCodificado);
				
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($cliente);
				$em->flush();
				$this->get('session')->setFlash('info', '¡Enhorabuena! Te has registrado correctamente en Sitpac');
				return $this->redirect($this->generateUrl('portada'));

			}
        }

		return $this->render('FrontendBundle:Cliente:registro.html.twig', array('formulario' => $formulario->createView()));		
        		

	}



	public function perfilAction()
	{
		$cliente = $this->get('security.context')->getToken()->getUser();
		$formulario = $this->createForm(new PerfilType(), $cliente);

		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$passwordOriginal = $formulario->getData()->getPassword();

			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				if (null == $cliente->getPassword()) {
					$cliente->setPassword($passwordOriginal);
				}
				else {
					$encoder = $this->get('security.encoder_factory')
					->getEncoder($cliente);
					$passwordCodificado = $encoder->encodePassword(
					$cliente->getPassword(),
					$cliente->getSalt());
					$cliente->setPassword($passwordCodificado);
				}
			// actualizar el perfil del usuario
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($cliente);
				$em->flush();
				$this->get('session')->setFlash('info', 'Los datos de tu perfil se han actualizado correctamente');
				return $this->redirect($this->generateUrl('cliente_perfil'));
			}
		}

		return $this->render('FrontendBundle:Cliente:perfil.html.twig', array(
		'cliente' => $cliente,
		'formulario' => $formulario->createView()
		));
	}

	public function pruebaReporteAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetesoperador('Aprobado');

		$html =$this->renderView('FrontendBundle:Cliente:pruebaReporte.html.twig',array(
		'paquetes' => $paquetes));

		return new Response(
	    $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
	    200,
	    array(
	        'Content-Type'          => 'application/pdf',
	        'Content-Disposition'   => 'attachment; filename="pruebaReporte.pdf"'
	    ));

	}

	public function portadaAction()
	{	


		$peticion = $this->getRequest();
		$paquete = new PaqueteTuristico();

		$formulario = $this->createForm(new BusquedaPaquetesType(), $paquete);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$municipio = $formulario->get('municipiomunicipio')->getData()->getIdmunicipio();
				$rangoprecios = $formulario->get('rangoPrecios')->getData();

				if($rangoprecios == 1){
					$precio1 = 50000;
					$precio2 = 100000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}

				if($rangoprecios == 2){
					$precio1 = 100000;
					$precio2 = 500000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}
				
				if($rangoprecios == 3){
					$precio1 = 500000;
					$precio2 = 1000000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}

				if($rangoprecios == 4){
					$precio1 = 1000000;
					$precio2 = 1500000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}

				if($rangoprecios == 5){
					$precio1 = 1500000;
					$precio2 = 2000000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}

				if($rangoprecios == 6){
					$precio1 = 2000000;
					$precio2 = 3000000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}

				if($rangoprecios == 7){
					$precio1 = 3000000;
					$precio2 = 5000000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}
			}
		}


		$em = $this->getDoctrine()->getManager();
        $paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetesoperador('Aprobado',4);
		return $this->render('FrontendBundle:Cliente:portada.html.twig',array('paquetes' => $paquetes,
		'formulario' => $formulario->createView() ));
	}

	public function busquedaPaquetesAction($lugar, $preciouno, $preciodos)
	{	


		$peticion = $this->getRequest();
		$paquete = new PaqueteTuristico();

		$formulario = $this->createForm(new BusquedaPaquetesType(), $paquete);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$municipio = $formulario->get('municipiomunicipio')->getData()->getIdmunicipio();
				$rangoprecios = $formulario->get('rangoPrecios')->getData();

								if($rangoprecios == 1){
					$precio1 = 50000;
					$precio2 = 100000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}

				if($rangoprecios == 2){
					$precio1 = 100000;
					$precio2 = 500000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}
				
				if($rangoprecios == 3){
					$precio1 = 500000;
					$precio2 = 1000000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}

				if($rangoprecios == 4){
					$precio1 = 1000000;
					$precio2 = 1500000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}

				if($rangoprecios == 5){
					$precio1 = 1500000;
					$precio2 = 2000000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}

				if($rangoprecios == 6){
					$precio1 = 2000000;
					$precio2 = 3000000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}

				if($rangoprecios == 7){
					$precio1 = 3000000;
					$precio2 = 5000000;
					$em = $this->getDoctrine()->getManager();
					
					$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
					->findBusquedaPaquetes($municipio, $precio1, $precio2, 'Aprobado');

					return $this->redirect($this->generateUrl('busqueda_paquetes',
					array('lugar' => $municipio, 'preciouno' => $precio1, 'preciodos' => $precio2 )));
				}
				
			}
		}

		$em = $this->getDoctrine()->getManager();					
		$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')
		->findBusquedaPaquetes($lugar, $preciouno, $preciodos, 'Aprobado');
		return $this->render('FrontendBundle:Cliente:BusquedaPaquetes.html.twig',array('paquetes' => $paquetes,
		'formulario' => $formulario->createView() ));
	}

	public function vermasPaquetesrAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquetesr = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetesoperador('Aprobado');
		
		$paginator  = $this->get('knp_paginator');
		$pagpaquetesr = $paginator->paginate( $paquetesr, $this->get('request')->query->get('page', 1), 12);
	

		return $this->render('FrontendBundle:Cliente:vermasPaquetesr.html.twig', array('paquetesr' => $paquetesr,
		 'pagpaquetesr' => $pagpaquetesr ));
	}


	public function paqueteDetallesClienteAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);
		$alojamiento = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerAlojByPaquete($id);
		$alimentacion = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerAlimByPaquete($id);
		$excursion = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerExcuByPaquete($id);
		$vehiculo = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerVehiByPaquete($id);
		$vuelo = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerVuelByPaquete($id);

		$paginator  = $this->get('knp_paginator');
		$pagalojamiento = $paginator->paginate( $alojamiento, $this->get('request')->query->get('page', 1), 12);
		$pagalimentacion = $paginator->paginate( $alimentacion, $this->get('request')->query->get('page', 1), 12);
		$pagexcursion = $paginator->paginate( $excursion, $this->get('request')->query->get('page', 1), 12);
		$pagvehiculo = $paginator->paginate( $vehiculo, $this->get('request')->query->get('page', 1), 12);
		$pagvuelo = $paginator->paginate( $vuelo, $this->get('request')->query->get('page', 1), 12);

		return $this->render('FrontendBundle:Cliente:detallesPaqueteCliente.html.twig', 
			array(
					'paquete' => $paquete,
					'alojamiento' => $alojamiento,
					'alimentacion' => $alimentacion,
					'excursion' => $excursion,
					'vehiculo' => $vehiculo,
					'vuelo' => $vuelo,
					'pagalojamiento' => $pagalojamiento,
					'pagalimentacion' => $pagalimentacion,
					'pagexcursion' => $pagexcursion,
					'pagvehiculo' => $pagvehiculo,
					'pagvuelo' => $pagvuelo,
				)
		);
	}

	public function verservicioalojAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioaloj = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioaloj($nombre, $idproducto);

		return $this->render('FrontendBundle:Cliente:servicioaloj.html.twig',array('servicioaloj' => $servicioaloj,
		'paquete' => $paquete
		));
	}


	public function verservicioalimAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioalim = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioalim($nombre, $idproducto);

		return $this->render('FrontendBundle:Cliente:servicioalim.html.twig',array('servicioalim' => $servicioalim,
		'paquete' => $paquete
		));
	}


	public function verservicioexcuAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioexcu = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioexcu($nombre, $idproducto);

		return $this->render('FrontendBundle:Cliente:servicioexcu.html.twig',array('servicioexcu' => $servicioexcu,
		'paquete' => $paquete
		));
	}


	public function verserviciovehiAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$serviciovehi = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovehi($nombre, $idproducto);

		return $this->render('FrontendBundle:Cliente:serviciovehi.html.twig',array('serviciovehi' => $serviciovehi,
		'paquete' => $paquete
		));
	}


	public function verserviciovuelAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$serviciovuel = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovuel($nombre, $idproducto);

		return $this->render('FrontendBundle:Cliente:serviciovuel.html.twig',array('serviciovuel' => $serviciovuel,
		'paquete' => $paquete
		));
	}




	public function verservicioalojclienteAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioaloj = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioaloj($nombre, $idproducto);

		return $this->render('FrontendBundle:Cliente:verservicioaloj.html.twig',array('servicioaloj' => $servicioaloj,
		'paquete' => $paquete,
		'idproducto' =>$idproducto
		));
	}


	public function verservicioalimclienteAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioalim = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioalim($nombre, $idproducto);

		return $this->render('FrontendBundle:Cliente:verservicioalim.html.twig',array('servicioalim' => $servicioalim,
		'paquete' => $paquete,
		'idproducto' =>$idproducto
		));
	}


	public function verservicioexcuclienteAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioexcu = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioexcu($nombre, $idproducto);

		return $this->render('FrontendBundle:Cliente:verservicioexcu.html.twig',array('servicioexcu' => $servicioexcu,
		'paquete' => $paquete,
		'idproducto' =>$idproducto
		));
	}


	public function verserviciovehiclienteAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$serviciovehi = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovehi($nombre, $idproducto);

		return $this->render('FrontendBundle:Cliente:verserviciovehi.html.twig',array('serviciovehi' => $serviciovehi,
		'paquete' => $paquete,
		'idproducto' =>$idproducto
		));
	}


	public function verserviciovuelclienteAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$serviciovuel = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovuel($nombre, $idproducto);

		return $this->render('FrontendBundle:Cliente:verserviciovuel.html.twig',array('serviciovuel' => $serviciovuel,
		'paquete' => $paquete,
		'idproducto' =>$idproducto
		));
	}
	




	public function paqueteNuevoAction()
	{
		$peticion = $this->getRequest();
		$paquete = new PaqueteTuristico();

		$formulario = $this->createForm(new PaqueteTuristicocType(), $paquete);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {

				$cliente = $this->get('security.context')->getToken()->getUser()->getIdcliente();
				$dura = $formulario->getData()->getDuracion();
				$inicio = $formulario->getData()->getFechaInicio()->format("Y-m-d");
				$fin = $formulario->getData()->getFechaCierre()->format("Y-m-d");


				$dias = (strtotime($inicio)-strtotime($fin))/86400;
       			$dias = abs($dias); 
       			$dias = floor($dias);
       			
       			$duracion = $dias+1;
       			
       			if($dura != $duracion){
       			   $this->get('session')->setFlash('info', 'Las fechas de inicio y fin deben coincidir con la duración');
					return $this->redirect($this->generateUrl('portada'));
       			}
       			
       			if($inicio > $fin){
					
					$this->get('session')->setFlash('info', 'La fecha de inicio debe ser menor a la de cierre');
					return $this->redirect($this->generateUrl('portada'));
				}

				$paquete->setCreadoCliente(true);
				$paquete->setCreador($cliente);
				//$paquete->setFechaExpiracion($expiracion);

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($paquete);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu nuevo paquete se a creado satisfactoriamente');
				return $this->redirect($this->generateUrl('portada'));
			}
		}
		return $this->render('FrontendBundle:Cliente:paqueteNuevo.html.twig', array(
		'accion' => 'crear',
		'formulario' => $formulario->createView()));
	}



	public function mispaquetesscAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$cliente = $this->get('security.context')->getToken()->getUser();
		$cliente->getIdcliente();
		$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findcreadorpaquetecliente($cliente, 'Creando');

		$paginator  = $this->get('knp_paginator');
		$pagpaquetes = $paginator->paginate( $paquetes, $this->get('request')->query->get('page', 1), 12);

		return $this->render('FrontendBundle:Cliente:mispaquetessc.html.twig',array('paquetes' => $paquetes,
		'pagpaquetes' => $pagpaquetes));
	}

	public function mispaquetespcAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$cliente = $this->get('security.context')->getToken()->getUser();
		$cliente->getIdcliente();
		$paquetess = $em->getRepository('FrontendBundle:PaqueteTuristico')->findcreadorpaquetecliente($cliente, 'Solicitud Registro');
		$paquetesp = $em->getRepository('FrontendBundle:PaqueteTuristico')->findcreadorpaquetecliente($cliente, 'Pendiente');
		

		return $this->render('FrontendBundle:Cliente:mispaquetespc.html.twig',array('paquetess' => $paquetess,
		'paquetesp' => $paquetesp,	
		));
	}

	public function mispaquetesacAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$cliente = $this->get('security.context')->getToken()->getUser();
		$cliente->getIdcliente();
		$paquetesa = $em->getRepository('FrontendBundle:PaqueteTuristico')->findcreadorpaquetecliente($cliente, 'Aprobado');
		$paquetesr = $em->getRepository('FrontendBundle:PaqueteTuristico')->findcreadorpaquetecliente($cliente, 'Rechazado');

		return $this->render('FrontendBundle:Cliente:mispaquetesac.html.twig',array('paquetesa' => $paquetesa,
		'paquetesr' => $paquetesr,
		));
	}


	public function enviarSolicitudPaqueteAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);
		$paquete->setEstado('Solicitud Registro');

		$em->persist($paquete);
		$em->flush();

		$this->get('session')->setFlash('info', 'La solicitud de registro de paquete se envio satisfactoriamente');
		return $this->redirect($this->generateUrl('mis_Paquetesscliente'));
	}


	public function serviciosAddAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);
		//debe ser los productos aprobdos solo por prueba esta en creando...
		$productos = $em->getRepository('ExtranetBundle:Producto')->findProductoservicios('Creando');

		$paginator  = $this->get('knp_paginator');
		$pagproductos = $paginator->paginate( $productos, $this->get('request')->query->get('page', 1), 24);

		return $this->render('FrontendBundle:Cliente:serviciosadd.html.twig',array(
		'paquete' => $paquete,
		'productos' => $productos,
		'pagproductos' => $pagproductos));
	}

	public function serviciosVerAction($id,$prod)
	{	
		// deben ser los servicios aprobados para pruebas estan en creando...
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($prod);

		$alojamientos = $em->getRepository('ExtranetBundle:ServicioAlojamiento')
		->findserviciosPaloj($producto->getIdproducto(), 'Creando');

		$alimentos = $em->getRepository('ExtranetBundle:ServicioAlimentacion')
		->findserviciosPalim($producto->getIdproducto(), 'Creando');

		$excursiones = $em->getRepository('ExtranetBundle:ServicioExcursion')
		->findserviciosPexcu($producto->getIdproducto(), 'Creando');

		$vehiculos = $em->getRepository('ExtranetBundle:ServicioVehiculo')
		->findserviciosPvehi($producto->getIdproducto(), 'Creando');

		$vuelos = $em->getRepository('ExtranetBundle:ServicioVuelo')
		->findserviciosPvuel($producto->getIdproducto(), 'Creando');


		return $this->render('FrontendBundle:Cliente:serviciosver.html.twig',array(
		'paquete' => $paquete,
		'producto' => $producto,
		'alojamientos' => $alojamientos,
		'alimentos' => $alimentos,
		'excursiones' => $excursiones,
		'vehiculos' => $vehiculos,
		'vuelos' => $vuelos,
		));
	}

	public function paqaloaddAction($paquete, $alojamiento)
	{

		$peticion = $this->getRequest();
		$servaloj = new ServicioPaqAlo();

		$em = $this->getDoctrine()->getEntityManager();
		$paquet = $em->getRepository('FrontendBundle:PaqueteTuristico')->findOneByIdpaqueteTuristico($paquete);
		$aloj = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->findOneByIdservicioAlojamiento($alojamiento);
		$disponibles = $em->getRepository('ExtranetBundle:Producto')->findDisponibleAlojamiento($alojamiento,'no disponible');
				
				$desde[]=null;
        		$hasta[]=null;

        		foreach($disponibles as $disponible)
            	{
                	$desde[]=date_format($disponible->getDesde(), 'm/d/Y');
                	$hasta[]=date_format($disponible->getHasta(), 'm/d/Y');           
            	}


		$formulario = $this->createForm(new ServicioPaqAlocType(), $servaloj);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {

				
				$em = $this->getDoctrine()->getEntityManager();

				$paq = $em->getRepository('FrontendBundle:PaqueteTuristico')->findOneByIdpaqueteTuristico($paquete);
				$alo = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->findOneByIdservicioAlojamiento($alojamiento);
				

				$foto = $alo->getFoto();
				$tiposervicio = $alo->getTipoAlojamiento();
				$precioservicio = $alo->getPrecio();
				$idproducto = $alo->getProductoproducto()->getIdproducto();
				$preciopaquete = $paq->getPreciototal();

				$servaloj->setFotoservicio($foto);
				$servaloj->setTiposervicio($tiposervicio);
				$servaloj->setPrecioservicio($precioservicio);
				$servaloj->setIdproducto($idproducto);
				$servaloj->setPaqueteTuristicopaqueteTuristico($paq);
				$servaloj->setServicioAlojamientoservicioAlojamiento($alo);
				$servaloj->setDescuento(0);

				$dura = $formulario->getData()->getDuracion();
				$inicio = $formulario->getData()->getFechaInicio()->format("Y-m-d");
				$fin = $formulario->getData()->getFechaFin()->format("Y-m-d");

				$dias = (strtotime($inicio)-strtotime($fin))/86400;
       			$dias = abs($dias); 
       			$dias = floor($dias);

       			$duracion = $dias+1;

       			if($dura != $duracion){
       			   $this->get('session')->setFlash('info', 'Las fechas de inicio y fin deben coincidir con la duración');
					return $this->redirect($this->generateUrl('todos_solicitados'));
       			}
       			
       			if($inicio > $fin){
					
					$this->get('session')->setFlash('info', 'La fecha de inicio debe ser menor a la de fin');
					return $this->redirect($this->generateUrl('todos_solicitados'));
				}

				$total = $preciopaquete + ($precioservicio * $duracion);
				$paq->setPreciototal($total);


				$em->persist($servaloj);
				$em->flush();

				$this->get('session')->setFlash('info', 'El servicio de Alojmiento se agrego satisfactoriamente');
				return $this->redirect($this->generateUrl('mis_Paquetesscliente'));
			}
		}
		return $this->render('FrontendBundle:Cliente:paqaloNuevo.html.twig', array(
		'desde' => $desde,
        'hasta' => $hasta,
		'paquete' => $paquete,
		'paquet' => $paquet,
		'aloj' => $aloj,
		'alojamiento' => $alojamiento,
		'formulario' => $formulario->createView()));
	}


	public function paqaliaddAction($paquete, $alimento)
	{

		$peticion = $this->getRequest();
		$servalim = new ServicioPaqAlim();

		$em = $this->getDoctrine()->getEntityManager();
		$paquet = $em->getRepository('FrontendBundle:PaqueteTuristico')->findOneByIdpaqueteTuristico($paquete);
		$alim = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->findOneByIdalimentacion($alimento);
		$disponibles = $em->getRepository('ExtranetBundle:Producto')->findDisponibleAlimentacion($alimento,'no disponible');
				
				$desde[]=null;
        		$hasta[]=null;

        		foreach($disponibles as $disponible)
            	{
                	$desde[]=date_format($disponible->getDesde(), 'm/d/Y');
                	$hasta[]=date_format($disponible->getHasta(), 'm/d/Y');           
            	}

		$formulario = $this->createForm(new ServicioPaqAlimcType(), $servalim);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {

				
				$em = $this->getDoctrine()->getEntityManager();

				$paq = $em->getRepository('FrontendBundle:PaqueteTuristico')->findOneByIdpaqueteTuristico($paquete);
				$ali = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->findOneByIdalimentacion($alimento);	

				$foto = $ali->getFoto();
				$nombre = $ali->getNombre();
				$precioservicio = $ali->getPrecio();
				$idproducto = $ali->getProductoproducto()->getIdproducto();
				$preciopaquete = $paq->getPreciototal();

				$servalim->setFotoservicio($foto);
				$servalim->setNombre($nombre);
				$servalim->setPrecioservicio($precioservicio);
				$servalim->setIdproducto($idproducto);
				$servalim->setPaqueteTuristicopaqueteTuristico($paq);
				$servalim->setServicioAlimentacionalimentacion($ali);
				$servalim->setDescuento(0);

				$dura = $formulario->getData()->getDuracion();
				$inicio = $formulario->getData()->getFechaInicio()->format("Y-m-d");
				$fin = $formulario->getData()->getFechaFin()->format("Y-m-d");

				$dias = (strtotime($inicio)-strtotime($fin))/86400;
       			$dias = abs($dias); 
       			$dias = floor($dias);

       			$duracion = $dias+1;

       			if($dura != $duracion){
       			   $this->get('session')->setFlash('info', 'Las fechas de inicio y fin deben coincidir con la duración');
					return $this->redirect($this->generateUrl('todos_solicitados'));
       			}
       			
       			if($inicio > $fin){
					
					$this->get('session')->setFlash('info', 'La fecha de inicio debe ser menor a la de fin');
					return $this->redirect($this->generateUrl('todos_solicitados'));
				}

				$total = $preciopaquete + ($precioservicio * $duracion);
				$paq->setPreciototal($total);


				$em->persist($servalim);
				$em->flush();

				$this->get('session')->setFlash('info', 'El servicio de Alimentacion se agrego satisfactoriamente');
				return $this->redirect($this->generateUrl('mis_Paquetesscliente'));
			}
		}
		return $this->render('FrontendBundle:Cliente:paqaliNuevo.html.twig', array(
		'desde' => $desde,
        'hasta' => $hasta,
		'paquete' => $paquete,
		'paquet' => $paquet,
		'alim' => $alim,
		'alimento' => $alimento,
		'formulario' => $formulario->createView()));
	}


	public function paqexcuaddAction($paquete, $excursion)
	{

		$peticion = $this->getRequest();
		$servexcu = new ServicioPaqExcu();

		$em = $this->getDoctrine()->getEntityManager();
		$paquet = $em->getRepository('FrontendBundle:PaqueteTuristico')->findOneByIdpaqueteTuristico($paquete);
		$excu = $em->getRepository('ExtranetBundle:ServicioExcursion')->findOneByIdexcursiones($excursion);
		$disponibles = $em->getRepository('ExtranetBundle:Producto')->findDisponibleExcursion($excursion,'no disponible');
				
				$desde[]=null;
        		$hasta[]=null;

        		foreach($disponibles as $disponible)
            	{
                	$desde[]=date_format($disponible->getDesde(), 'm/d/Y');
                	$hasta[]=date_format($disponible->getHasta(), 'm/d/Y');           
            	}


		$formulario = $this->createForm(new ServicioPaqExcucType(), $servexcu);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {

				
				$em = $this->getDoctrine()->getEntityManager();

				$paq = $em->getRepository('FrontendBundle:PaqueteTuristico')->findOneByIdpaqueteTuristico($paquete);
				$excu = $em->getRepository('ExtranetBundle:ServicioExcursion')->findOneByIdexcursiones($excursion);


				

				$foto = $excu->getFoto();
				$nombre = $excu->getNombre();
				$precioservicio = $excu->getPrecio();
				$idproducto = $excu->getProductoproducto()->getIdproducto();
				$preciopaquete = $paq->getPreciototal();

				$servexcu->setFotoservicio($foto);
				$servexcu->setNombre($nombre);
				$servexcu->setPrecioservicio($precioservicio);
				$servexcu->setIdproducto($idproducto);
				$servexcu->setPaqueteTuristicopaqueteTuristico($paq);
				$servexcu->setServicioExcursionexcursiones($excu);
				$servexcu->setDescuento(0);

				$dura = $formulario->getData()->getDuracion();
				$inicio = $formulario->getData()->getFechaInicio()->format("Y-m-d");
				$fin = $formulario->getData()->getFechaFin()->format("Y-m-d");

				$dias = (strtotime($inicio)-strtotime($fin))/86400;
       			$dias = abs($dias); 
       			$dias = floor($dias);

       			$duracion = $dias+1;

       			if($dura != $duracion){
       			   $this->get('session')->setFlash('info', 'Las fechas de inicio y fin deben coincidir con la duración');
					return $this->redirect($this->generateUrl('todos_solicitados'));
       			}
       			
       			if($inicio > $fin){
					
					$this->get('session')->setFlash('info', 'La fecha de inicio debe ser menor a la de fin');
					return $this->redirect($this->generateUrl('todos_solicitados'));
				}

				$total = $preciopaquete + ($precioservicio * $duracion);
				$paq->setPreciototal($total);


				$em->persist($servexcu);
				$em->flush();

				$this->get('session')->setFlash('info', 'El servicio de Excursion se agrego satisfactoriamente');
				return $this->redirect($this->generateUrl('mis_Paquetesscliente'));
			}
		}
		return $this->render('FrontendBundle:Cliente:paqexcuNuevo.html.twig', array(
		'desde' => $desde,
        'hasta' => $hasta,
		'paquete' => $paquete,
		'paquet' => $paquet,
		'excu' => $excu,
		'excursion' => $excursion,
		'formulario' => $formulario->createView()));
	}


	public function paqvehiaddAction($paquete, $vehiculo)
	{

		$peticion = $this->getRequest();
		$servvehi = new ServicioPaqVehi();

		$em = $this->getDoctrine()->getEntityManager();
		$paquet = $em->getRepository('FrontendBundle:PaqueteTuristico')->findOneByIdpaqueteTuristico($paquete);
		$vehi = $em->getRepository('ExtranetBundle:ServicioVehiculo')->findOneByIdservicioVehiculo($vehiculo);
		$disponibles = $em->getRepository('ExtranetBundle:Producto')->findDisponibleVehiculo($vehiculo,'no disponible');
				
				$desde[]=null;
        		$hasta[]=null;

        		foreach($disponibles as $disponible)
            	{
                	$desde[]=date_format($disponible->getDesde(), 'm/d/Y');
                	$hasta[]=date_format($disponible->getHasta(), 'm/d/Y');           
            	}

		$formulario = $this->createForm(new ServicioPaqVehicType(), $servvehi);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {

				
				$em = $this->getDoctrine()->getEntityManager();

				$paq = $em->getRepository('FrontendBundle:PaqueteTuristico')->findOneByIdpaqueteTuristico($paquete);
				$vehi = $em->getRepository('ExtranetBundle:ServicioVehiculo')->findOneByIdservicioVehiculo($vehiculo);


				

				$foto = $vehi->getFoto();
				$tipo = $vehi->getTipo();
				$precioservicio = $vehi->getPrecio();
				$idproducto = $vehi->getProductoproducto()->getIdproducto();
				$preciopaquete = $paq->getPreciototal();

				$servvehi->setFotoservicio($foto);
				$servvehi->setTipoServicio($tipo);
				$servvehi->setPrecioservicio($precioservicio);
				$servvehi->setIdproducto($idproducto);
				$servvehi->setPaqueteTuristicopaqueteTuristico($paq);
				$servvehi->setServicioVehiculoservicioVehiculo($vehi);
				$servvehi->setDescuento(0);

				$dura = $formulario->getData()->getDuracion();
				$inicio = $formulario->getData()->getFechaInicio()->format("Y-m-d");
				$fin = $formulario->getData()->getFechaFin()->format("Y-m-d");

				$dias = (strtotime($inicio)-strtotime($fin))/86400;
       			$dias = abs($dias); 
       			$dias = floor($dias);

       			$duracion = $dias+1;

       			if($dura != $duracion){
       			   $this->get('session')->setFlash('info', 'Las fechas de inicio y fin deben coincidir con la duración');
					return $this->redirect($this->generateUrl('todos_solicitados'));
       			}
       			
       			if($inicio > $fin){
					
					$this->get('session')->setFlash('info', 'La fecha de inicio debe ser menor a la de fin');
					return $this->redirect($this->generateUrl('todos_solicitados'));
				}

				$total = $preciopaquete + ($precioservicio * $duracion);
				$paq->setPreciototal($total);


				$em->persist($servvehi);
				$em->flush();

				$this->get('session')->setFlash('info', 'El servicio de Vehiculo se agrego satisfactoriamente');
				return $this->redirect($this->generateUrl('mis_Paquetesscliente'));
			}
		}
		return $this->render('FrontendBundle:Cliente:paqvehiNuevo.html.twig', array(
		'desde' => $desde,
        'hasta' => $hasta,
		'paquete' => $paquete,
		'paquet' => $paquet,
		'vehi' => $vehi,
		'vehiculo' => $vehiculo,
		'formulario' => $formulario->createView()));
	}



	public function paqvueladdAction($paquete, $vuelo)
	{

		$peticion = $this->getRequest();
		$servvuel = new ServicioPaqVuel();

		$em = $this->getDoctrine()->getEntityManager();
		$paquet = $em->getRepository('FrontendBundle:PaqueteTuristico')->findOneByIdpaqueteTuristico($paquete);
		$vuel = $em->getRepository('ExtranetBundle:ServicioVuelo')->findOneByIdservicioVuelo($vuelo);
		$disponibles = $em->getRepository('ExtranetBundle:Producto')->findDisponibleVuelo($vuelo,'no disponible');
				
				$desde[]=null;
        		$hasta[]=null;

        		foreach($disponibles as $disponible)
            	{
                	$desde[]=date_format($disponible->getDesde(), 'm/d/Y');
                	$hasta[]=date_format($disponible->getHasta(), 'm/d/Y');           
            	}

		$formulario = $this->createForm(new ServicioPaqVuelcType(), $servvuel);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {

				
				$em = $this->getDoctrine()->getEntityManager();

				$paq = $em->getRepository('FrontendBundle:PaqueteTuristico')->findOneByIdpaqueteTuristico($paquete);
				$vuel = $em->getRepository('ExtranetBundle:ServicioVuelo')->findOneByIdservicioVuelo($vuelo);


				

				$foto = $vuel->getFoto();
				$compania = $vuel->getCompania();
				$precioservicio = $vuel->getPrecio();
				$idproducto = $vuel->getProductoproducto()->getIdproducto();
				$preciopaquete = $paq->getPreciototal();

				$servvuel->setFotoservicio($foto);
				$servvuel->setCompania($compania);
				$servvuel->setPrecioservicio($precioservicio);
				$servvuel->setIdproducto($idproducto);
				$servvuel->setPaqueteTuristicopaqueteTuristico($paq);
				$servvuel->setServicioVueloservicioVuelo($vuel);
				$servvuel->setDescuento(0);


				$total = $preciopaquete + $precioservicio;
				$paq->setPreciototal($total);


				$em->persist($servvuel);
				$em->flush();

				$this->get('session')->setFlash('info', 'El servicio de Vuelo se agrego satisfactoriamente');
				return $this->redirect($this->generateUrl('mis_Paquetesscliente'));
			}
		}
		return $this->render('FrontendBundle:Cliente:paqvuelNuevo.html.twig', array(
		'desde' => $desde,
        'hasta' => $hasta,
		'paquete' => $paquete,
		'paquet' => $paquet,
		'vuel' => $vuel,
		'vuelo' => $vuelo,
		'formulario' => $formulario->createView()));
	}


	public function reservanuevaAction($paquete)
	{
		$peticion = $this->getRequest();
		$reserva = new Reserva();

		$formulario = $this->createForm(new ReservaType(), $reserva);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				
				$em = $this->getDoctrine()->getEntityManager();

				$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
				$id = $paquete->getIdpaqueteTuristico();
				$alojamientos = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerAlojByPaquete($id);
				$alimentaciones = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerAlimByPaquete($id);
				$excursiones = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerExcuByPaquete($id);
				$vehiculos = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerVehiByPaquete($id);
				$vuelos = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerVuelByPaquete($id);

				$adultos = $formulario->getData()->getAdultos();
				$ninos = $formulario->getData()->getNinos();
				$cliente = $this->get('security.context')->getToken()->getUser();
				$nomcliente = $cliente->getNombres().' '.$cliente->getApellidos();
				$preciopaquete = $paquete->getPrecioTotal();
				$total = $preciopaquete * $adultos;
				if($ninos > 0){
					$total = $total + ($preciopaquete * $ninos);
				}

				$reserva->setNombreCliente($nomcliente);
				$reserva->setNombrePaquete($paquete->getNombre());
				$reserva->setDescripcion($paquete->getDescripcion());
				$reserva->setFechaInicio($paquete->getFechaInicio());
				$reserva->setFechaCierre($paquete->getFechaCierre());
				$reserva->setDuracion($paquete->getDuracion());
				$reserva->setPrecioPaquete($paquete->getPrecioTotal());
				$reserva->setPrecioTotal($total);
				$reserva->setClientecliente($cliente);
				$reserva->setPaqueteTuristicopaqueteTuristico($paquete);


				if($alojamientos){

					foreach($alojamientos as $alojamiento)
            		{	
            			$intalojamiento = new IntinerarioReserva();
            			$producto = $em->getRepository('ExtranetBundle:Producto')->find($alojamiento->getIdProducto());
            			$idservicio = $alojamiento->getServicioAlojamientoservicioAlojamiento()->getIdservicioAlojamiento();
            			$servicio = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($idservicio);
                		$nomprod = $producto->getNombre();
                		$idproveedor = $producto->getProveedorproveedor()->getIdproveedor();
                		$nomserv = $servicio->getTipoAlojamiento();
                		$detalles = $servicio->getDetalles();
                		$intalojamiento->setNombreProducto($nomprod);
                		$intalojamiento->setNombreServicio($nomserv);
                		$intalojamiento->setDetalles($detalles);
                		$intalojamiento->setDuracion($alojamiento->getDuracion());
                		$intalojamiento->setFechaInicio($alojamiento->getFechaInicio());
                		$intalojamiento->setFechaFin($alojamiento->getFechaFin());
                		$intalojamiento->setDescuento($alojamiento->getDescuento());
                		$intalojamiento->setPrecioServicio($alojamiento->getPrecioServicio());
                		$intalojamiento->setIdProveedor($idproveedor);
                		$intalojamiento->setIdReserva($reserva);

                		$em->persist($intalojamiento);

            		}
				}

				if($alimentaciones){

					foreach($alimentaciones as $alimentacion)
            		{
            			$intalimentacion = new IntinerarioReserva();
            			$producto = $em->getRepository('ExtranetBundle:Producto')->find($alimentacion->getIdProducto());
            			$idservicio = $alimentacion->getServicioAlimentacionalimentacion()->getIdalimentacion();
            			$servicio = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($idservicio);
                		$nomprod = $producto->getNombre();
                		$idproveedor = $producto->getProveedorproveedor()->getIdproveedor();
                		$nomserv = $servicio->getNombre();
                		$detalles = $servicio->getDetalles();
                		$intalimentacion->setNombreProducto($nomprod);
                		$intalimentacion->setNombreServicio($nomserv);
                		$intalimentacion->setDetalles($detalles);
                		$intalimentacion->setDuracion($alimentacion->getDuracion());
                		$intalimentacion->setFechaInicio($alimentacion->getFechaInicio());
                		$intalimentacion->setFechaFin($alimentacion->getFechaFin());
                		$intalimentacion->setDescuento($alimentacion->getDescuento());
                		$intalimentacion->setPrecioServicio($alimentacion->getPrecioServicio());
                		$intalimentacion->setIdProveedor($idproveedor);
                		$intalimentacion->setIdReserva($reserva);

                		$em->persist($intalimentacion);

            		}
				}

				if($excursiones){

					foreach($excursiones as $excursion)
            		{
            			$intexcursion = new IntinerarioReserva();
            			$producto = $em->getRepository('ExtranetBundle:Producto')->find($excursion->getIdProducto());
            			$idservicio = $excursion->getServicioExcursionexcursiones()->getIdexcursiones();
            			$servicio = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($idservicio);
                		$nomprod = $producto->getNombre();
                		$idproveedor = $producto->getProveedorproveedor()->getIdproveedor();
                		$nomserv = $servicio->getNombre();
                		$detalles = $servicio->getDetalles();
                		$intexcursion->setNombreProducto($nomprod);
                		$intexcursion->setNombreServicio($nomserv);
                		$intexcursion->setDetalles($detalles);
                		$intexcursion->setDuracion($excursion->getDuracion());
                		$intexcursion->setFechaInicio($excursion->getFechaInicio());
                		$intexcursion->setFechaFin($excursion->getFechaFin());
                		$intexcursion->setDescuento($excursion->getDescuento());
                		$intexcursion->setPrecioServicio($excursion->getPrecioServicio());
                		$intexcursion->setIdProveedor($idproveedor);
                		$intexcursion->setIdReserva($reserva);

                		$em->persist($intexcursion);

            		}
				}

				if($vehiculos){

					foreach($vehiculos as $vehiculo)
            		{
            			$intvehiculo = new IntinerarioReserva();
            			$producto = $em->getRepository('ExtranetBundle:Producto')->find($vehiculo->getIdProducto());
            			$idservicio = $vehiculo->getServicioVehiculoservicioVehiculo()->getIdservicioVehiculo();
            			$servicio = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($idservicio);
                		$nomprod = $producto->getNombre();
                		$idproveedor = $producto->getProveedorproveedor()->getIdproveedor();
                		$nomserv = $servicio->getTipo();
                		$detalles = $servicio->getDetalles();
                		$intvehiculo->setNombreProducto($nomprod);
                		$intvehiculo->setNombreServicio($nomserv);
                		$intvehiculo->setDetalles($detalles);
                		$intvehiculo->setDuracion($vehiculo->getDuracion());
                		$intvehiculo->setFechaInicio($vehiculo->getFechaInicio());
                		$intvehiculo->setFechaFin($vehiculo->getFechaFin());
                		$intvehiculo->setDescuento($vehiculo->getDescuento());
                		$intvehiculo->setPrecioServicio($vehiculo->getPrecioServicio());
                		$intvehiculo->setIdProveedor($idproveedor);
                		$intvehiculo->setIdReserva($reserva);

                		$em->persist($intvehiculo);

            		}
				}

				if($vuelos){

					foreach($vuelos as $vuelo)
            		{
            			$intvuelo = new IntinerarioReserva();
            			$producto = $em->getRepository('ExtranetBundle:Producto')->find($vuelo->getIdProducto());
            			$idservicio = $vuelo->getServicioVueloservicioVuelo()->getIdservicioVuelo();
            			$servicio = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($idservicio);
                		$nomprod = $producto->getNombre();
                		$idproveedor = $producto->getProveedorproveedor()->getIdproveedor();
                		$nomserv = $servicio->getCompania();
                		$detalles = $servicio->getDetalles();
                		$intvuelo->setNombreProducto($nomprod);
                		$intvuelo->setNombreServicio($nomserv);
                		$intvuelo->setDetalles($detalles);
                		$intvuelo->setDuracion(1);
                		$intvuelo->setFechaInicio($vuelo->getFechaVuelo());
                		$intvuelo->setFechaFin($vuelo->getFechaVuelo());
                		$intvuelo->setDescuento($vuelo->getDescuento());
                		$intvuelo->setPrecioServicio($vuelo->getPrecioServicio());
                		$intvuelo->setIdProveedor($idproveedor);
                		$intvuelo->setIdReserva($reserva);

                		$em->persist($intvuelo);
            		}
				}				

				        		
        		$em->persist($reserva);
        		$em->flush();

				$this->get('session')->setFlash('info', 'La solicitud de reserva se realizo satisfactoriamente');
				return $this->redirect($this->generateUrl('portada'));

			}
		}

		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);

		return $this->render('FrontendBundle:Cliente:reservanueva.html.twig',array('paquete' => $paquete,
		'formulario' => $formulario->createView()
		));
	}


	public function reservasrealizadasAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$cliente = $this->get('security.context')->getToken()->getUser();
		$cliente->getIdcliente();
		$reservas = $em->getRepository('FrontendBundle:Reserva')->findReservascliente($cliente, 'En Reserva');

		$paginator  = $this->get('knp_paginator');
		$pagreservas = $paginator->paginate( $reservas, $this->get('request')->query->get('page', 1), 20);

		return $this->render('FrontendBundle:Cliente:reservasrealizadas.html.twig',array('reservas' => $reservas,
		'pagreservas' => $pagreservas,));
	}

	public function detallesreservaAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$reserva = $em->getRepository('FrontendBundle:Reserva')->find($id);
		$intinerario = $em->getRepository('FrontendBundle:Reserva')->findIntinerarioreserva($id);

		return $this->render('FrontendBundle:Cliente:detallesreserva.html.twig',array('reserva' => $reserva,
		'intinerario' => $intinerario,));
		
	}

	public function detallescompraAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$reserva = $em->getRepository('FrontendBundle:Reserva')->find($id);
		$intinerario = $em->getRepository('FrontendBundle:Reserva')->findIntinerarioreserva($id);

		return $this->render('FrontendBundle:Cliente:detallescompra.html.twig',array('reserva' => $reserva,
		'intinerario' => $intinerario,));
		
	}

	public function reservaspagadasAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$cliente = $this->get('security.context')->getToken()->getUser();
		$cliente->getIdcliente();
		$reservas = $em->getRepository('FrontendBundle:Reserva')->findReservasPagascliente($cliente, 'Pagada');

		$paginator  = $this->get('knp_paginator');
		$pagreservas = $paginator->paginate( $reservas, $this->get('request')->query->get('page', 1), 20);

		return $this->render('FrontendBundle:Cliente:reservaspagadas.html.twig',array('reservas' => $reservas,
		'pagreservas' => $pagreservas,));
	}

	public function pqrnuevaAction()
	{
		$peticion = $this->getRequest();
		$pqr = new Pqr();
		$em = $this->getDoctrine()->getEntityManager();

		$formulario = $this->createForm(new PqrType(), $pqr);
		

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$cliente = $this->get('security.context')->getToken()->getUser();
 								
				$pqr->setClientecliente($cliente);
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($pqr);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu (PQR) se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portada'));
			}
		}					
		return $this->render('FrontendBundle:Cliente:pqrnueva.html.twig', array(
		'formulario' => $formulario->createView(),)); 	
	}

	public function vertodaspqrAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$cliente = $this->get('security.context')->getToken()->getUser()->getIdcliente();
		
		$peticiones = $em->getRepository('FrontendBundle:Pqr')->findTodasPqrs($cliente);

		return $this->render('FrontendBundle:Cliente:vertodaspqr.html.twig', array('peticiones' => $peticiones));
	}

	public function vermaspqrAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$peticion = $em->getRepository('FrontendBundle:Pqr')->find($id);

		return $this->render('FrontendBundle:Cliente:vermaspqr.html.twig', array('peticion' => $peticion));
	}

	public function confirmacionpagoAction()
	{	
		return $this->render('FrontendBundle:Cliente:confirmacionpago.html.php');	
	}


}