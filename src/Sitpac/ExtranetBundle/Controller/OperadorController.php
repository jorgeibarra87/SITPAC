<?php

namespace Sitpac\ExtranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Sitpac\ExtranetBundle\Entity\Operador;
use Sitpac\ExtranetBundle\Form\OperadorType;
use Sitpac\ExtranetBundle\Form\perfiloType;

use Sitpac\FrontendBundle\Entity\PaqueteTuristico;
use Sitpac\ExtranetBundle\Form\PaqueteTuristicoType;

use Sitpac\FrontendBundle\Entity\ServicioPaqAlo;
use Sitpac\FrontendBundle\Form\ServicioPaqAloType;

use Sitpac\FrontendBundle\Entity\ServicioPaqAlim;
use Sitpac\FrontendBundle\Form\ServicioPaqAlimType;

use Sitpac\FrontendBundle\Entity\ServicioPaqExcu;
use Sitpac\FrontendBundle\Form\ServicioPaqExcuType;

use Sitpac\FrontendBundle\Entity\ServicioPaqVehi;
use Sitpac\FrontendBundle\Form\ServicioPaqVehiType;

use Sitpac\FrontendBundle\Entity\ServicioPaqVuel;
use Sitpac\FrontendBundle\Form\ServicioPaqVuelType;

use Sitpac\ExtranetBundle\Form\SolicitudrespuestaType;

use Sitpac\ExtranetBundle\Form\PqrrespuestaType;


class OperadorController extends Controller
{
	
	public function loginAction()
	{
		$peticion = $this->getRequest();
		$sesion = $peticion->getSession();
		$error = $peticion->attributes->get(
		SecurityContext::AUTHENTICATION_ERROR,
		$sesion->get(SecurityContext::AUTHENTICATION_ERROR)
		);
		return $this->render('ExtranetBundle:Operador:login.html.twig', array(
		'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
		'error' => $error
		));
	}


	public function portadaOperadorAction()
	{	
		$em = $this->getDoctrine()->getManager();
        $paquetess = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetescliente('Solicitud registro',4);
        $paquetesp = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetescliente('Pendiente',4);
        $paquetesa = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetescliente('Aprobado',4);
		return $this->render('ExtranetBundle:Operador:portadaOperador.html.twig',array(
		'paquetess' => $paquetess,
		'paquetesp' => $paquetesp,
		'paquetesa' => $paquetesa));
	}


	public function detallesPaquetesAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);
		$alojamiento = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerAlojByPaquete($id);
		$alimentacion = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerAlimByPaquete($id);
		$excursion = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerExcuByPaquete($id);
		$vehiculo = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerVehiByPaquete($id);
		$vuelo = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerVuelByPaquete($id);

		return $this->render('ExtranetBundle:Operador:detallesPaquete.html.twig', 
			array(
					'paquete' => $paquete,
					'alojamiento' => $alojamiento,
					'alimentacion' => $alimentacion,
					'excursion' => $excursion,
					'vehiculo' => $vehiculo,
					'vuelo' => $vuelo
				)
		);
	}

	public function detallesPaquetesoAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);
		$alojamiento = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerAlojByPaquete($id);
		$alimentacion = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerAlimByPaquete($id);
		$excursion = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerExcuByPaquete($id);
		$vehiculo = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerVehiByPaquete($id);
		$vuelo = $em->getRepository('FrontendBundle:PaqueteTuristico')->findSerVuelByPaquete($id);

		return $this->render('ExtranetBundle:Operador:detallesPaqueteo.html.twig', 
			array(
					'paquete' => $paquete,
					'alojamiento' => $alojamiento,
					'alimentacion' => $alimentacion,
					'excursion' => $excursion,
					'vehiculo' => $vehiculo,
					'vuelo' => $vuelo
				)
		);
	}


	public function solicitadosAction()
	{	
		$em = $this->getDoctrine()->getManager();
        $paquetess = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetescliente('Solicitud registro');

        $paginator  = $this->get('knp_paginator');
		$pagpaquetess = $paginator->paginate( $paquetess, $this->get('request')->query->get('page', 1), 20);
		return $this->render('ExtranetBundle:Operador:solicitados.html.twig',array('paquetess' => $paquetess,
		'pagpaquetess' => $pagpaquetess
		));
	}

	public function pendientesAction()
	{	
		$em = $this->getDoctrine()->getManager();
        $paquetesp = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetescliente('Pendiente');

        $paginator  = $this->get('knp_paginator');
		$pagpaquetesp = $paginator->paginate( $paquetesp, $this->get('request')->query->get('page', 1), 20);
		return $this->render('ExtranetBundle:Operador:pendientes.html.twig',array('paquetesp' => $paquetesp,
		'pagpaquetesp' => $pagpaquetesp
		));
	}

	public function aprobadosAction()
	{	
		$em = $this->getDoctrine()->getManager();
        $paquetesa = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetescliente('Aprobado');

        $paginator  = $this->get('knp_paginator');
		$pagpaquetesa = $paginator->paginate( $paquetesa, $this->get('request')->query->get('page', 1), 20);
		return $this->render('ExtranetBundle:Operador:aprobados.html.twig',array('paquetesa' => $paquetesa,
		'pagpaquetesa' => $pagpaquetesa
		));
	}


	public function mispaquetessoAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$operador = $this->get('security.context')->getToken()->getUser();
		$operador->getIdoperador();
		//$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findcreadorpaquete($operador, 'Solicitud registro');
		$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetesoperador('Solicitud registro');

		return $this->render('ExtranetBundle:Operador:mispaquetesso.html.twig',array('paquetes' => $paquetes));
	}


	public function mispaquetespoAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$operador = $this->get('security.context')->getToken()->getUser();
		$operador->getIdoperador();
		//$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findcreadorpaquete($operador, 'Pendiente');
		$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetesoperador('Pendiente');

		return $this->render('ExtranetBundle:Operador:mispaquetespo.html.twig',array('paquetes' => $paquetes));
	}


	public function mispaquetesaoAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$operador = $this->get('security.context')->getToken()->getUser();
		$operador->getIdoperador();
		//$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findcreadorpaquete($operador, 'Aprobado');
		$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetesoperador('Aprobado');

		return $this->render('ExtranetBundle:Operador:mispaquetesao.html.twig',array('paquetes' => $paquetes));
	}



	public function cambiarpaqaPendienteAction($id)
	{	
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);
		$creador = $paquete->getCreadoCliente();

		$paquete->setEstado('Pendiente');

		$em->flush();
		$this->get('session')->setFlash('info', 
		'El paquete cambio su estado a pendiente');

		if($creador == 1){
			return $this->redirect($this->generateUrl('todos_solicitados'));	
		}

		if($creador == 0){
			return $this->redirect($this->generateUrl('mis_Paquetesso'));	
		}

		
	}





	public function provsolicitadosAction()
	{	
		$em = $this->getDoctrine()->getManager();
        $provs = $em->getRepository('ExtranetBundle:Proveedor')->findProveedores('Solicitud registro');
		return $this->render('ExtranetBundle:Operador:provsolicitados.html.twig',array('provs' => $provs));
	}

	public function provpendientesAction()
	{	
		$em = $this->getDoctrine()->getManager();
        $provp = $em->getRepository('ExtranetBundle:Proveedor')->findProveedores('Pendiente');
		return $this->render('ExtranetBundle:Operador:provpendientes.html.twig',array('provp' => $provp));
	}

	public function provaprobadosAction()
	{	
		$em = $this->getDoctrine()->getManager();
        $prova = $em->getRepository('ExtranetBundle:Proveedor')->findProveedores('Aprobado');
		return $this->render('ExtranetBundle:Operador:provaprobados.html.twig',array('prova' => $prova));
	}

	public function cambiaraPendienteAction($id)
	{	
		$em = $this->getDoctrine()->getEntityManager();
		$proveedor = $em->getRepository('ExtranetBundle:Proveedor')->find($id);

		$proveedor->setEstado('Pendiente');

		$em->flush();
		$this->get('session')->setFlash('info', 
		'El proveedor cambio su estado a pendiente');

		return $this->redirect($this->generateUrl('proveedores_solicitados'));
	}



	public function prodsolicitadosAction()
	{	
		$em = $this->getDoctrine()->getManager();
        $prods = $em->getRepository('ExtranetBundle:Producto')->findProductosestado('Solicitud registro');
		return $this->render('ExtranetBundle:Operador:prodsolicitados.html.twig',array('prods' => $prods));
	}

	public function prodpendientesAction()
	{	
		$em = $this->getDoctrine()->getManager();
        $prodp = $em->getRepository('ExtranetBundle:Producto')->findProductosestado('Pendiente');
		return $this->render('ExtranetBundle:Operador:prodpendientes.html.twig',array('prodp' => $prodp));
	}

	public function prodaprobadosAction()
	{	
		$em = $this->getDoctrine()->getManager();
        $proda = $em->getRepository('ExtranetBundle:Producto')->findProductosestado('Aprobado');
		return $this->render('ExtranetBundle:Operador:prodaprobados.html.twig',array('proda' => $proda));
	}

	public function cambiaraprodaPendienteAction($id)
	{	
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($id);
		
		if (!$producto) {
        throw $this->createNotFoundException('error producto no existe ');
    	}

    	$alojamiento = $em->getRepository('ExtranetBundle:Producto')->findSerAlojByProducto($id);
    	$alimentacion = $em->getRepository('ExtranetBundle:Producto')->findSerAlimByProducto($id);
    	$excursion = $em->getRepository('ExtranetBundle:Producto')->findSerExcurByProducto($id);
    	$vehiculo = $em->getRepository('ExtranetBundle:Producto')->findSerVehicByProducto($id);
    	$vuelo= $em->getRepository('ExtranetBundle:Producto')->findSerVuelByProducto($id);

    	$producto->setEstado('Pendiente');
    	if ($alojamiento != null) {
    		foreach($alojamiento as $aloj)
			{
    			$aloj->setEstado('Pendiente');
			}
    		
    	}
    	if ($alimentacion != null) {
    		foreach($alimentacion as $alim)
			{
    			$alim->setEstado('Pendiente');
			}
    	}
    	if ($excursion != null) {
    		foreach($excursion as $excu)
			{
    			$excu->setEstado('Pendiente');
			}
    	}
    	if ($vehiculo != null) {
    		foreach($vehiculo as $vehi)
			{
    			$vehi->setEstado('Pendiente');
			}
    	}
    	if ($vuelo != null) {
    		foreach($vuelo as $vuel)
			{
    			$vuel->setEstado('Pendiente');
			}
    	}

		$em->flush();
		$this->get('session')->setFlash('info', 
		'El producto cambio su estado a pendiente');

		return $this->redirect($this->generateUrl('productos_solicitados'));
	}


	public function detallesproductoAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($id);
		$alojamiento = $em->getRepository('ExtranetBundle:Producto')->findSerAlojByProducto($id);
		$alimentacion = $em->getRepository('ExtranetBundle:Producto')->findSerAlimByProducto($id);
		$excursion = $em->getRepository('ExtranetBundle:Producto')->findSerExcurByProducto($id);
		$vehiculo = $em->getRepository('ExtranetBundle:Producto')->findSerVehicByProducto($id);
		$vuelo = $em->getRepository('ExtranetBundle:Producto')->findSerVuelByProducto($id);

		return $this->render('ExtranetBundle:Operador:detallesproducto.html.twig', 
			array(
					'producto' => $producto,
					'alojamiento' => $alojamiento,
					'alimentacion' => $alimentacion,
					'excursion' => $excursion,
					'vehiculo' => $vehiculo,
					'vuelo' => $vuelo
				)
		);
	}



	public function verservicioalojAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioaloj = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioaloj($nombre, $idproducto);

		return $this->render('ExtranetBundle:Operador:servicioaloj.html.twig',array('servicioaloj' => $servicioaloj,
		'paquete' => $paquete
		));
	}


	public function verservicioalimAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioalim = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioalim($nombre, $idproducto);

		return $this->render('ExtranetBundle:Operador:servicioalim.html.twig',array('servicioalim' => $servicioalim,
		'paquete' => $paquete
		));
	}


	public function verservicioexcuAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioexcu = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioexcu($nombre, $idproducto);

		return $this->render('ExtranetBundle:Operador:servicioexcu.html.twig',array('servicioexcu' => $servicioexcu,
		'paquete' => $paquete
		));
	}


	public function verserviciovehiAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$serviciovehi = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovehi($nombre, $idproducto);

		return $this->render('ExtranetBundle:Operador:serviciovehi.html.twig',array('serviciovehi' => $serviciovehi,
		'paquete' => $paquete
		));
	}


	public function verservicivuelAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$serviciovuel = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovuel($nombre, $idproducto);

		return $this->render('ExtranetBundle:Operador:serviciovuel.html.twig',array('serviciovuel' => $serviciovuel,
		'paquete' => $paquete
		));
	}




	public function verservicioalojoperadorAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioaloj = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioaloj($nombre, $idproducto);

		return $this->render('ExtranetBundle:Operador:verservicioaloj.html.twig',array('servicioaloj' => $servicioaloj,
		'paquete' => $paquete
		));
	}


	public function verservicioalimoperadorAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioalim = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioalim($nombre, $idproducto);

		return $this->render('ExtranetBundle:Operador:verservicioalim.html.twig',array('servicioalim' => $servicioalim,
		'paquete' => $paquete
		));
	}


	public function verservicioexcuoperadorAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$servicioexcu = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioexcu($nombre, $idproducto);

		return $this->render('ExtranetBundle:Operador:verservicioexcu.html.twig',array('servicioexcu' => $servicioexcu,
		'paquete' => $paquete
		));
	}


	public function verserviciovehioperadorAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$serviciovehi = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovehi($nombre, $idproducto);

		return $this->render('ExtranetBundle:Operador:verserviciovehi.html.twig',array('serviciovehi' => $serviciovehi,
		'paquete' => $paquete
		));
	}


	public function verservicivueloperadorAction($nombre, $idproducto, $paquete)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
		$serviciovuel = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovuel($nombre, $idproducto);

		return $this->render('ExtranetBundle:Operador:verserviciovuel.html.twig',array('serviciovuel' => $serviciovuel,
		'paquete' => $paquete
		));
	}




	public function vermasAlojamientoAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$alojamiento = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);

		return $this->render('ExtranetBundle:Operador:vermasAlojamiento.html.twig',array('alojamiento' => $alojamiento));
	}
	public function vermasAlimentacionAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$alimentacion = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);

		return $this->render('ExtranetBundle:Operador:vermasAlimentacion.html.twig',array('alimentacion' => $alimentacion));
	}
	public function vermasExcursionAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$excursion = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);

		return $this->render('ExtranetBundle:Operador:vermasExcursion.html.twig',array('excursion' => $excursion));
	}
	public function vermasVehiculoAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$vehiculo = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);

		return $this->render('ExtranetBundle:Operador:vermasVehiculo.html.twig',array('vehiculo' => $vehiculo));
	}
	public function vermasVueloAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$vuelo = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);

		return $this->render('ExtranetBundle:Operador:vermasVuelo.html.twig',array('vuelo' => $vuelo));
	}



	public function paqueteNuevoAction()
	{
		$peticion = $this->getRequest();
		$paquete = new PaqueteTuristico();

		$formulario = $this->createForm(new PaqueteTuristicoType(), $paquete);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$operador = $this->get('security.context')->getToken()->getUser()->getIdoperador();
				$paquete->setCreadoCliente(false);
				$paquete->setCreador($operador);
				$paquete->subirFoto();
				$dura = $formulario->getData()->getDuracion();
				$inicio = $formulario->getData()->getFechaInicio()->format("Y-m-d");
				$fin = $formulario->getData()->getFechaCierre()->format("Y-m-d");


				$dias = (strtotime($inicio)-strtotime($fin))/86400;
       			$dias = abs($dias); 
       			$dias = floor($dias);
       			$duracion = $dias+1;
       			
       			if($dura != $duracion){
       			   $this->get('session')->setFlash('info', 'Las fechas de inicio y fin deben coincidir con la duración');
					return $this->redirect($this->generateUrl('portadao'));
       			}
       			
       			if($inicio > $fin){
					
					$this->get('session')->setFlash('info', 'La fecha de inicio debe ser menor a la de cierre');
					return $this->redirect($this->generateUrl('portadao'));
				}


				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($paquete);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu nuevo paquete se a creado satisfactoriamente');
				return $this->redirect($this->generateUrl('portadao'));
			}
		}
		return $this->render('ExtranetBundle:Operador:paqueteNuevo.html.twig', array(
		'accion' => 'crear',
		'formulario' => $formulario->createView()));
	}

	public function serviciosAddoAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);
		//debe ser los productos aprobdos solo por prueba esta en creando...
		$productos = $em->getRepository('ExtranetBundle:Producto')->findProductoservicios('Creando');

		$paginator  = $this->get('knp_paginator');
		$pagproductos = $paginator->paginate( $productos, $this->get('request')->query->get('page', 1), 24);

		return $this->render('ExtranetBundle:Operador:serviciosadd.html.twig',array(
		'paquete' => $paquete,
		'productos' => $productos,
		'pagproductos' => $pagproductos));
	}

	public function serviciosVeroAction($id,$prod)
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


		return $this->render('ExtranetBundle:Operador:serviciosver.html.twig',array(
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



		$formulario = $this->createForm(new ServicioPaqAloType(), $servaloj);

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

				$dura = $formulario->getData()->getDuracion();
				$inicio = $formulario->getData()->getFechaInicio()->format("Y-m-d");
				$fin = $formulario->getData()->getFechaFin()->format("Y-m-d");

				$dias = (strtotime($inicio)-strtotime($fin))/86400;
       			$dias = abs($dias); 
       			$dias = floor($dias);

       			$duracion = $dias+1;

       			if($dura != $duracion){
       			   $this->get('session')->setFlash('info', 'Las fechas de inicio y fin deben coincidir con la duración');
					return $this->redirect($this->generateUrl('mis_Paquetesso'));
       			}
       			
       			if($inicio > $fin){
					
					$this->get('session')->setFlash('info', 'La fecha de inicio debe ser menor a la de fin');
					return $this->redirect($this->generateUrl('mis_Paquetesso'));
				} 
				$descuento = $formulario->getData()->getDescuento();
				$descuento = $descuento/100;

				$total = $preciopaquete + ((($precioservicio - ($precioservicio * $descuento))) * $duracion);
				$paq->setPreciototal($total);


				$em->persist($servaloj);
				$em->persist($paq);
				$em->flush();

				$this->get('session')->setFlash('info', 'El servicio de Alojmiento se agrego satisfactoriamente');
				return $this->redirect($this->generateUrl('mis_Paquetesso'));
			}
		}
		return $this->render('ExtranetBundle:Operador:paqaloNuevo.html.twig', array(
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

		$formulario = $this->createForm(new ServicioPaqAlimType(), $servalim);

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

				$dura = $formulario->getData()->getDuracion();
				$inicio = $formulario->getData()->getFechaInicio()->format("Y-m-d");
				$fin = $formulario->getData()->getFechaFin()->format("Y-m-d");

				$dias = (strtotime($inicio)-strtotime($fin))/86400;
       			$dias = abs($dias); 
       			$dias = floor($dias);

       			$duracion = $dias+1;

       			if($dura != $duracion){
       			   $this->get('session')->setFlash('info', 'Las fechas de inicio y fin deben coincidir con la duración');
					return $this->redirect($this->generateUrl('mis_Paquetesso'));
       			}
       			
       			if($inicio > $fin){
					
					$this->get('session')->setFlash('info', 'La fecha de inicio debe ser menor a la de fin');
					return $this->redirect($this->generateUrl('mis_Paquetesso'));
				}  
				$descuento = $formulario->getData()->getDescuento();
				$descuento = $descuento/100;

				$total = $preciopaquete + ((($precioservicio - ($precioservicio * $descuento))) * $duracion);

				$paq->setPreciototal($total);


				$em->persist($servalim);
				$em->persist($paq);
				$em->flush();

				$this->get('session')->setFlash('info', 'El servicio de Alimentacion se agrego satisfactoriamente');
				return $this->redirect($this->generateUrl('mis_Paquetesso'));
			}
		}
		return $this->render('ExtranetBundle:Operador:paqaliNuevo.html.twig', array(
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

		$formulario = $this->createForm(new ServicioPaqExcuType(), $servexcu);

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


				$dura = $formulario->getData()->getDuracion();
				$inicio = $formulario->getData()->getFechaInicio()->format("Y-m-d");
				$fin = $formulario->getData()->getFechaFin()->format("Y-m-d");

				$dias = (strtotime($inicio)-strtotime($fin))/86400;
       			$dias = abs($dias); 
       			$dias = floor($dias);

       			$duracion = $dias+1;

       			if($dura != $duracion){
       			   $this->get('session')->setFlash('info', 'Las fechas de inicio y fin deben coincidir con la duración');
					return $this->redirect($this->generateUrl('mis_Paquetesso'));
       			}
       			
       			if($inicio > $fin){
					
					$this->get('session')->setFlash('info', 'La fecha de inicio debe ser menor a la de fin');
					return $this->redirect($this->generateUrl('mis_Paquetesso'));
				} 
				$descuento = $formulario->getData()->getDescuento();
				$descuento = $descuento/100;

				$total = $preciopaquete + ((($precioservicio - ($precioservicio * $descuento))) * $duracion);

				$paq->setPreciototal($total);


				$em->persist($servexcu);
				$em->persist($paq);
				$em->flush();

				$this->get('session')->setFlash('info', 'El servicio de Excursion se agrego satisfactoriamente');
				return $this->redirect($this->generateUrl('mis_Paquetesso'));
			}
		}
		return $this->render('ExtranetBundle:Operador:paqexcuNuevo.html.twig', array(
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

		$formulario = $this->createForm(new ServicioPaqVehiType(), $servvehi);

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


				$dura = $formulario->getData()->getDuracion();
				$inicio = $formulario->getData()->getFechaInicio()->format("Y-m-d");
				$fin = $formulario->getData()->getFechaFin()->format("Y-m-d");

				$dias = (strtotime($inicio)-strtotime($fin))/86400;
       			$dias = abs($dias); 
       			$dias = floor($dias);

       			$duracion = $dias+1;

       			if($dura != $duracion){
       			   $this->get('session')->setFlash('info', 'Las fechas de inicio y fin deben coincidir con la duración');
					return $this->redirect($this->generateUrl('mis_Paquetesso'));
       			}
       			
       			if($inicio > $fin){
					
					$this->get('session')->setFlash('info', 'La fecha de inicio debe ser menor a la de fin');
					return $this->redirect($this->generateUrl('mis_Paquetesso'));
				}
				$descuento = $formulario->getData()->getDescuento();
				$descuento = $descuento/100;

				$total = $preciopaquete + ((($precioservicio - ($precioservicio * $descuento))) * $duracion);

				$paq->setPreciototal($total);


				$em->persist($servvehi);
				$em->persist($paq);
				$em->flush();

				$this->get('session')->setFlash('info', 'El servicio de Vehiculo se agrego satisfactoriamente');
				return $this->redirect($this->generateUrl('mis_Paquetesso'));
			}
		}
		return $this->render('ExtranetBundle:Operador:paqvehiNuevo.html.twig', array(
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

		$formulario = $this->createForm(new ServicioPaqVuelType(), $servvuel);

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


				$descuento = $formulario->getData()->getDescuento();
				$descuento = $descuento/100;

				$total = $preciopaquete + (($precioservicio - ($precioservicio * $descuento)));
				$paq->setPreciototal($total);


				$em->persist($servvuel);
				$em->persist($paq);
				$em->flush();

				$this->get('session')->setFlash('info', 'El servicio de Vuelo se agrego satisfactoriamente');
				return $this->redirect($this->generateUrl('mis_Paquetesso'));
			}
		}
		return $this->render('ExtranetBundle:Operador:paqvuelNuevo.html.twig', array(
		'desde' => $desde,
        'hasta' => $hasta,
		'paquete' => $paquete,
		'paquet' => $paquet,
		'vuel' => $vuel,
		'vuelo' => $vuelo,
		'formulario' => $formulario->createView()));
	}

	public function verTodasSolicitudessAction()
	{
		$em = $this->getDoctrine()->getEntityManager();	
		$solicitudes = $em->getRepository('ExtranetBundle:Producto')->findSolicitudestado('En Solicitud');
		$paginator  = $this->get('knp_paginator');
		$pagsolicitudes = $paginator->paginate( $solicitudes, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Operador:verTodasSolicitudess.html.twig', array('solicitudes' => $solicitudes,
		'pagsolicitudes' => $pagsolicitudes
		));
	}

	public function verTodasSolicitudespAction()
	{
		$em = $this->getDoctrine()->getEntityManager();	
		$solicitudes = $em->getRepository('ExtranetBundle:Producto')->findSolicitudestado('Pendiente');
		$paginator  = $this->get('knp_paginator');
		$pagsolicitudes = $paginator->paginate( $solicitudes, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Operador:verTodasSolicitudesp.html.twig', array('solicitudes' => $solicitudes,
		'pagsolicitudes' => $pagsolicitudes
		));
	}

	public function verTodasSolicitudesaAction()
	{
		$em = $this->getDoctrine()->getEntityManager();	
		$solicitudes = $em->getRepository('ExtranetBundle:Producto')->findSolicitudestado('Aprobada');
		$paginator  = $this->get('knp_paginator');
		$pagsolicitudes = $paginator->paginate( $solicitudes, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Operador:verTodasSolicitudesa.html.twig', array('solicitudes' => $solicitudes,
		'pagsolicitudes' => $pagsolicitudes
		));
	}

	public function vermasSolicitudesoAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$solicitud = $em->getRepository('ExtranetBundle:solicitudes')->find($id);

		return $this->render('ExtranetBundle:Operador:vermasSolicitudeso.html.twig', array('solicitud' => $solicitud));
	}

	public function respuestasolicitudAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$solicitud = $em->getRepository('ExtranetBundle:solicitudes')->find($id);

		$peticion = $this->getRequest();
		$formulario = $this->createForm(new SolicitudrespuestaType(), $solicitud);

		if ($peticion->getMethod() == 'POST') {

			$formulario->bind($peticion);
			
			if ($formulario->isValid()) {		
				
				$em = $this->getDoctrine()->getEntityManager();
				$solicitud->setEstado('Pendiente');
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Su respuesta se agrego y la solicitud cambio su estado a pendiente');
				return $this->redirect(	$this->generateUrl('ver_solicitudesp'));
			}
		}

		return $this->render('ExtranetBundle:Operador:respuestasolicitud.html.twig', array('solicitud' => $solicitud,
		'formulario' => $formulario->createView()));
	}


	public function vertodaspqrssAction()
	{
		$em = $this->getDoctrine()->getEntityManager();		
		$peticiones = $em->getRepository('FrontendBundle:Pqr')->findPqrsestado('PQR Solicitada');
		$paginator  = $this->get('knp_paginator');
		$pagpeticiones = $paginator->paginate( $peticiones, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Operador:vertodaspqrss.html.twig', array('peticiones' => $peticiones,
		'pagpeticiones' => $pagpeticiones
		));
	}

	public function vertodaspqrspAction()
	{
		$em = $this->getDoctrine()->getEntityManager();		
		$peticiones = $em->getRepository('FrontendBundle:Pqr')->findPqrsestado('PQR Pendiente');
		$paginator  = $this->get('knp_paginator');
		$pagpeticiones = $paginator->paginate( $peticiones, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Operador:vertodaspqrsp.html.twig', array('peticiones' => $peticiones,
		'pagpeticiones' => $pagpeticiones
		));
	}

	public function vertodaspqrsaAction()
	{
		$em = $this->getDoctrine()->getEntityManager();		
		$peticiones = $em->getRepository('FrontendBundle:Pqr')->findPqrsestado('PQR Aprobada');
		$paginator  = $this->get('knp_paginator');
		$pagpeticiones = $paginator->paginate( $peticiones, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Operador:vertodaspqrsa.html.twig', array('peticiones' => $peticiones,
		'pagpeticiones' => $pagpeticiones
		));
	}

	public function vermaspqroAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$peticion = $em->getRepository('FrontendBundle:Pqr')->find($id);

		return $this->render('ExtranetBundle:Operador:vermaspqro.html.twig', array('peticion' => $peticion));
	}

	public function respuestapqrAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$pqr = $em->getRepository('FrontendBundle:Pqr')->find($id);

		$peticion = $this->getRequest();
		$formulario = $this->createForm(new PqrrespuestaType(), $pqr);

		if ($peticion->getMethod() == 'POST') {

			$formulario->bind($peticion);
			
			if ($formulario->isValid()) {		
				
				$em = $this->getDoctrine()->getEntityManager();
				$pqr->setEstado('PQR Pendiente');
				$em->persist($pqr);
				$em->flush();
				$this->get('session')->setFlash('info', 'Su respuesta se agrego y la pqr cambio su estado a pendiente');
				return $this->redirect(	$this->generateUrl('ver_todaspqrsp'));
			}
		}

		return $this->render('ExtranetBundle:Operador:respuestapqr.html.twig', array('pqr' => $pqr,
		'formulario' => $formulario->createView()));
	}

	public function vertodosclientesAction()
	{
		$em = $this->getDoctrine()->getEntityManager();		
		$clientes = $em->getRepository('FrontendBundle:Cliente')->findtodosclientes();
		$paginator  = $this->get('knp_paginator');
		$pagclientes = $paginator->paginate( $clientes, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Operador:vertodosclientes.html.twig', array('clientes' => $clientes,
		'pagclientes' => $pagclientes
		));
	}

	public function vertodasreservasAction()
	{
		$em = $this->getDoctrine()->getEntityManager();;
		$reservas = $em->getRepository('FrontendBundle:Reserva')->findTodasreservas('En Reserva');

		$paginator  = $this->get('knp_paginator');
		$pagreservas = $paginator->paginate( $reservas, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Operador:vertodasreservas.html.twig',array('reservas' => $reservas,
		'pagreservas' => $pagreservas,));
	}

	public function detallesreservaoAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$reserva = $em->getRepository('FrontendBundle:Reserva')->find($id);
		$intinerario = $em->getRepository('FrontendBundle:Reserva')->findIntinerarioreserva($id);

		return $this->render('ExtranetBundle:Operador:detallesreservao.html.twig',array('reserva' => $reserva,
		'intinerario' => $intinerario,));
		
	}

	public function reservaspagadasoAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$reservas = $em->getRepository('FrontendBundle:Reserva')->findReservasPagas('Pagada');

		$paginator  = $this->get('knp_paginator');
		$pagreservas = $paginator->paginate( $reservas, $this->get('request')->query->get('page', 1), 20);

		return $this->render('ExtranetBundle:Operador:reservaspagadaso.html.twig',array('reservas' => $reservas,
		'pagreservas' => $pagreservas,));
	}

	public function detallescompraoAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$reserva = $em->getRepository('FrontendBundle:Reserva')->find($id);
		$intinerario = $em->getRepository('FrontendBundle:Reserva')->findIntinerarioreserva($id);

		return $this->render('ExtranetBundle:Operador:detallescomprao.html.twig',array('reserva' => $reserva,
		'intinerario' => $intinerario,));
		
	}


}