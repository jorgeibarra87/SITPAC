<?php

namespace Sitpac\ExtranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sitpac\ExtranetBundle\Entity\Producto;
use Sitpac\ExtranetBundle\Form\ProductoType;
use Sitpac\ExtranetBundle\Form\ProductoeditarType;

use Sitpac\ExtranetBundle\Entity\ServicioAlojamiento;
use Sitpac\ExtranetBundle\Form\ServicioAlojamientoType;

use Sitpac\ExtranetBundle\Entity\ServicioAlimentacion;
use Sitpac\ExtranetBundle\Form\ServicioAlimentacionType;

use Sitpac\ExtranetBundle\Entity\ServicioExcursion;
use Sitpac\ExtranetBundle\Form\ServicioExcursionType;

use Sitpac\ExtranetBundle\Entity\ServicioVehiculo;
use Sitpac\ExtranetBundle\Form\ServicioVehiculoType;

use Sitpac\ExtranetBundle\Entity\ServicioVuelo;
use Sitpac\ExtranetBundle\Form\ServicioVueloType;

use Sitpac\ExtranetBundle\Entity\DisponibilidadAlo;
use Sitpac\ExtranetBundle\Form\AlojamientoDisponibleType;

use Sitpac\ExtranetBundle\Entity\DisponibilidadAlim;
use Sitpac\ExtranetBundle\Form\AlimentacionDisponibleType;

use Sitpac\ExtranetBundle\Entity\DisponibilidadExcu;
use Sitpac\ExtranetBundle\Form\ExcursionDisponibleType;

use Sitpac\ExtranetBundle\Entity\DisponibilidadVehi;
use Sitpac\ExtranetBundle\Form\VehiculoDisponibleType;

use Sitpac\ExtranetBundle\Entity\DisponibilidadVuel;
use Sitpac\ExtranetBundle\Form\VueloDisponibleType;

use Sitpac\ExtranetBundle\Entity\Solicitudes;
use Sitpac\ExtranetBundle\Form\SolicitudType;

use Symfony\Component\HttpFoundation\RedirectResponse;



class ProductoController extends Controller
{
	
	public function verAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$proveedor = $this->get('security.context')->getToken()->getUser();
		$productos = $em->getRepository('ExtranetBundle:Producto')->findProductos($proveedor->getIdproveedor());
		return $this->render('ExtranetBundle:Producto:ver.html.twig', array('productos' => $productos));
	}

	public function detallesAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($id);
		$alojamiento = $em->getRepository('ExtranetBundle:Producto')->findSerAlojByProducto($id);
		$alimentacion = $em->getRepository('ExtranetBundle:Producto')->findSerAlimByProducto($id);
		$excursion = $em->getRepository('ExtranetBundle:Producto')->findSerExcurByProducto($id);
		$vehiculo = $em->getRepository('ExtranetBundle:Producto')->findSerVehicByProducto($id);
		$vuelo = $em->getRepository('ExtranetBundle:Producto')->findSerVuelByProducto($id);



		$paginator  = $this->get('knp_paginator');
		$pagalojamiento = $paginator->paginate( $alojamiento, $this->get('request')->query->get('page', 1), 12);
		$pagalimentacion = $paginator->paginate( $alimentacion, $this->get('request')->query->get('page', 1), 12);
		$pagexcursion = $paginator->paginate( $excursion, $this->get('request')->query->get('page', 1), 12);
		$pagvehiculo = $paginator->paginate( $vehiculo, $this->get('request')->query->get('page', 1), 12);
		$pagvuelo = $paginator->paginate( $vuelo, $this->get('request')->query->get('page', 1), 12);


		return $this->render('ExtranetBundle:Producto:detalles.html.twig', 
			array(
					'producto' => $producto,
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

	public function vermasAlojamientoAction($id, $producto)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$alojamiento = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		return $this->render('ExtranetBundle:Producto:vermasAlojamiento.html.twig',array('alojamiento' => $alojamiento,
		'producto' => $producto
		));
	}
	public function vermasAlimentacionAction($id, $producto)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$alimentacion = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		return $this->render('ExtranetBundle:Producto:vermasAlimentacion.html.twig',array('alimentacion' => $alimentacion,
		'producto' => $producto
		));
	}
	public function vermasExcursionAction($id, $producto)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$excursion = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		return $this->render('ExtranetBundle:Producto:vermasExcursion.html.twig',array('excursion' => $excursion,
		'producto' => $producto
		));
	}
	public function vermasVehiculoAction($id, $producto)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$vehiculo = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		return $this->render('ExtranetBundle:Producto:vermasVehiculo.html.twig',array('vehiculo' => $vehiculo,
		'producto' => $producto
		));
	}
	public function vermasVueloAction($id, $producto)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$vuelo = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		return $this->render('ExtranetBundle:Producto:vermasVuelo.html.twig',array('vuelo' => $vuelo,
		'producto' => $producto
		));
	}


	public function vermasAlojamientosAction($id, $producto)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$alojamiento = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		return $this->render('ExtranetBundle:Producto:vermasAlojamientos.html.twig',array('alojamiento' => $alojamiento,
		'producto' => $producto
		));
	}
	public function vermasAlimentacionsAction($id, $producto)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$alimentacion = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		return $this->render('ExtranetBundle:Producto:vermasAlimentacions.html.twig',array('alimentacion' => $alimentacion,
		'producto' => $producto
		));
	}
	public function vermasExcursionsAction($id, $producto)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$excursion = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		return $this->render('ExtranetBundle:Producto:vermasExcursions.html.twig',array('excursion' => $excursion,
		'producto' => $producto
		));
	}
	public function vermasVehiculosAction($id, $producto)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$vehiculo = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		return $this->render('ExtranetBundle:Producto:vermasVehiculos.html.twig',array('vehiculo' => $vehiculo,
		'producto' => $producto
		));
	}
	public function vermasVuelosAction($id, $producto)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$vuelo = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		return $this->render('ExtranetBundle:Producto:vermasVuelos.html.twig',array('vuelo' => $vuelo,
		'producto' => $producto
		));
	}


	public function productoNuevoAction()
	{
		$peticion = $this->getRequest();
		$producto = new Producto();

		$formulario = $this->createForm(new ProductoType(), $producto);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$proveedor = $this->get('security.context')->getToken()->getUser();
				$proveedor->getIdproveedor();
				$producto->setProveedorproveedor($proveedor);
				$producto->subirFoto();
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($producto);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu nuevo producto se a creado satisfactoriamente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}
		return $this->render('ExtranetBundle:Producto:productoNuevo.html.twig', array(
		'accion' => 'crear',
		'formulario' => $formulario->createView()));
	}


	public function alojamientoNuevoAction($id)
	{

		$peticion = $this->getRequest();
		$servicio = new ServicioAlojamiento();

		$formulario = $this->createForm(new ServicioAlojamientoType(), $servicio);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$producto = $this->getDoctrine()->getRepository('ExtranetBundle:Producto')->find($id);
 								
				$servicio->setProductoproducto($producto);
				$servicio->subirFoto();
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($servicio);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu nuevo servicio de alojamiento se a creado satisfactoriamente');
				return $this->redirect($this->generateUrl('producto_verdetalles', array('id' => $id)));
			}
		}					
		return $this->render('ExtranetBundle:Producto:nuevoAlojamiento.html.twig', array(
		'formulario' => $formulario->createView(),
		'id' => $id)); 	

		
	}



	public function alimentacionNuevoAction($id)
	{

		$peticion = $this->getRequest();
		$servicio = new ServicioAlimentacion();

		$formulario = $this->createForm(new ServicioAlimentacionType(), $servicio);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$producto = $this->getDoctrine()->getRepository('ExtranetBundle:Producto')->find($id);
 								
				$servicio->setProductoproducto($producto);
				$servicio->subirFoto();
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($servicio);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu nuevo servicio de alimentacion se a creado satisfactoriamente');
				return $this->redirect($this->generateUrl('producto_verdetalles', array('id' => $id)));
			}
		}					
		return $this->render('ExtranetBundle:Producto:nuevoAlimentacion.html.twig', array(
		'formulario' => $formulario->createView(),
		'id' => $id)); 	

		
	}



	public function excursionNuevoAction($id)
	{

		$peticion = $this->getRequest();
		$servicio = new ServicioExcursion();

		$formulario = $this->createForm(new ServicioExcursionType(), $servicio);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$producto = $this->getDoctrine()->getRepository('ExtranetBundle:Producto')->find($id);
 								
				$servicio->setProductoproducto($producto);
				$servicio->subirFoto();
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($servicio);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu nuevo servicio de excursion se a creado satisfactoriamente');
				return $this->redirect($this->generateUrl('producto_verdetalles', array('id' => $id)));
			}
		}					
		return $this->render('ExtranetBundle:Producto:nuevoExcursion.html.twig', array(
		'formulario' => $formulario->createView(),
		'id' => $id)); 	

		
	}



	public function vehiculoNuevoAction($id)
	{

		$peticion = $this->getRequest();
		$servicio = new ServicioVehiculo();

		$formulario = $this->createForm(new ServicioVehiculoType(), $servicio);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$producto = $this->getDoctrine()->getRepository('ExtranetBundle:Producto')->find($id);
 								
				$servicio->setProductoproducto($producto);
				$servicio->subirFoto();
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($servicio);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu nuevo servicio de vehiculo se a creado satisfactoriamente');
				return $this->redirect($this->generateUrl('producto_verdetalles', array('id' => $id)));
			}
		}					
		return $this->render('ExtranetBundle:Producto:nuevoVehiculo.html.twig', array(
		'formulario' => $formulario->createView(),
		'id' => $id)); 	

		
	}



	public function vueloNuevoAction($id)
	{

		$peticion = $this->getRequest();
		$servicio = new ServicioVuelo();

		$formulario = $this->createForm(new ServicioVueloType(), $servicio);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$producto = $this->getDoctrine()->getRepository('ExtranetBundle:Producto')->find($id);
 								
				$servicio->setProductoproducto($producto);
				$servicio->subirFoto();
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($servicio);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu nuevo servicio de vuelo se a creado satisfactoriamente');
				return $this->redirect($this->generateUrl('producto_verdetalles', array('id' => $id)));
			}
		}					
		return $this->render('ExtranetBundle:Producto:nuevoVuelo.html.twig', array(
		'formulario' => $formulario->createView(),
		'id' => $id)); 	

		
	}


	public function productoEditarAction($id)
	{
		//$peticion = $this->getRequest();
		//$producto = new Producto();

		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($id);

		if (!$producto) {
		throw $this->createNotFoundException('El producto no existe');
		}

		//if ($producto->getEstado()=="Comprado") {

		//$this->get('session')->setFlash('info', 'El producto no se puede modificar porque ya ha sido comprado' );
		//return $this->redirect($this->generateUrl('portadap'));
		//}

		$peticion = $this->getRequest();
		$formulario = $this->createForm(new ProductoType(), $producto);

		if ($peticion->getMethod() == 'POST') {
			
			$fotoOriginal = $producto->getFoto();

			$formulario->bind($peticion);
			
			if ($formulario->isValid()) {		
				

				if (null == $producto->getFoto()) {
					// La foto original no se modifica, recuperar su ruta
					$producto->setFoto($fotoOriginal);
				} 
				else {
					// La foto del producto se ha modificado
					$directorioFotos = __DIR__.'/../../../../web/uploads/images';
					
					$producto->subirFoto($directorioFotos);
					
					// Borrar la foto anterior
					unlink($directorioFotos.$fotoOriginal);
				}



				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($producto);
				$em->flush();
				$this->get('session')->setFlash('info', 'El producto se editó satisfactoriamente');
				return $this->redirect(	$this->generateUrl('portadap'));
			}
		}

		return $this->render('ExtranetBundle:Producto:productoNuevo.html.twig', array(
		'accion' => 'editar',
		'producto' => $producto,
		'formulario' => $formulario->createView()));
		
	}

	public function verTodasSolicitudesAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$proveedor = $this->get('security.context')->getToken()->getUser()->getIdproveedor();
		
		$solicitudes = $em->getRepository('ExtranetBundle:Producto')->findTodasSolicitudes($proveedor);

		return $this->render('ExtranetBundle:Producto:verTodasSolicitudes.html.twig', array('solicitudes' => $solicitudes));
	}

	public function vermasSolicitudesAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$solicitud = $em->getRepository('ExtranetBundle:solicitudes')->find($id);

		return $this->render('ExtranetBundle:Producto:vermasSolicitudes.html.twig', array('solicitud' => $solicitud));
	}

	public function productoEnviarSolicitudAction($id)
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

    	$producto->setEstado('Solicitud Registro');
    	if ($alojamiento != null) {
    		foreach($alojamiento as $aloj)
			{
    			$aloj->setEstado('Solicitud Registro');
			}
    		
    	}
    	if ($alimentacion != null) {
    		foreach($alimentacion as $alim)
			{
    			$alim->setEstado('Solicitud Registro');
			}
    	}
    	if ($excursion != null) {
    		foreach($excursion as $excu)
			{
    			$excu->setEstado('Solicitud Registro');
			}
    	}
    	if ($vehiculo != null) {
    		foreach($vehiculo as $vehi)
			{
    			$vehi->setEstado('Solicitud Registro');
			}
    	}
    	if ($vuelo != null) {
    		foreach($vuelo as $vuel)
			{
    			$vuel->setEstado('Solicitud Registro');
			}
    	}
		
		$em->flush();
		$this->get('session')->setFlash('info', 'Tu Solicitud de Producto se a enviado para su estudio y posterior aprobacion');

		$paginator  = $this->get('knp_paginator');
		$pagalojamiento = $paginator->paginate( $alojamiento, $this->get('request')->query->get('page', 1), 8);
		$pagalimentacion = $paginator->paginate( $alimentacion, $this->get('request')->query->get('page', 1), 8);
		$pagexcursion = $paginator->paginate( $excursion, $this->get('request')->query->get('page', 1), 8);
		$pagvehiculo = $paginator->paginate( $vehiculo, $this->get('request')->query->get('page', 1), 8);
		$pagvuelo = $paginator->paginate( $vuelo, $this->get('request')->query->get('page', 1), 8);


		return $this->render('ExtranetBundle:Producto:detalles.html.twig', 
			array(
					'producto' => $producto,
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


	public function alojamientoDisponibleAction($id, $producto)
    {	

    	$peticion = $this->getRequest();
		$disponiblealo = new DisponibilidadAlo();
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new AlojamientoDisponibleType(), $disponiblealo);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
 								
				$em = $this->getDoctrine()->getEntityManager();
				$servicio = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);
				$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);
				$disponiblealo->setIdServAlo($servicio);
				$em->persist($disponiblealo);
				$em->flush();
				$this->get('session')->setFlash('info', 'La disponibilidad se a actualizado satisfactoriamente');
				return $this->redirect($this->generateUrl('disponible_Alojamiento', array('id' => $id,
				'producto' => $producto
				)));
			}
		}					


        $em = $this->getDoctrine()->getEntityManager();
        $disponibles = $em->getRepository('ExtranetBundle:Producto')->findDisponibleAlojamiento($id,'no disponible');
        $servicio = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);
        //echo '<pre>'.print_r($disponibles, true).'</pre>';exit;
        //$arreglofechas = array();
        $desde[]=null;
        $hasta[]=null;
        foreach($disponibles as $disponible)
            {
                $desde[]=date_format($disponible->getDesde(), 'm/d/Y');
                $hasta[]=date_format($disponible->getHasta(), 'm/d/Y');
                //$arreglofechas ='"'.$desde.','.$hasta.'"'; 
                //$salarreglofechas = implode(',',$arreglofechas);              
            }

        
        return $this->render('ExtranetBundle:Producto:disponibilidadAlojamiento.html.twig', array(
        'desde' => $desde,
        'hasta' => $hasta,
        'id'=> $id,
        'servicio'=> $servicio,
        'producto' => $producto,
        'formulario' => $formulario->createView()
        ));
    }


	public function alimentacionDisponibleAction($id, $producto)
    {	

    	$peticion = $this->getRequest();
		$disponiblealim = new DisponibilidadAlim();
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new AlimentacionDisponibleType(), $disponiblealim);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
 								
				$em = $this->getDoctrine()->getEntityManager();
				$servicio = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);
				$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);
				$disponiblealim->setIdServAlim($servicio);
				$em->persist($disponiblealim);
				$em->flush();
				$this->get('session')->setFlash('info', 'La disponibilidad se a actualizado satisfactoriamente');
				return $this->redirect($this->generateUrl('disponible_Alimentacion', array('id' => $id,
				'producto' => $producto
				)));
			}
		}					


        $em = $this->getDoctrine()->getEntityManager();
        $disponibles = $em->getRepository('ExtranetBundle:Producto')->findDisponibleAlimentacion($id,'no disponible');
        $servicio = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);
        //echo '<pre>'.print_r($disponibles, true).'</pre>';exit;
        //$arreglofechas = array();
        $desde[]=null;
        $hasta[]=null;
        foreach($disponibles as $disponible)
            {
                $desde[]=date_format($disponible->getDesde(), 'm/d/Y');
                $hasta[]=date_format($disponible->getHasta(), 'm/d/Y');
                //$arreglofechas ='"'.$desde.','.$hasta.'"'; 
                //$salarreglofechas = implode(',',$arreglofechas);              
            }

        
        return $this->render('ExtranetBundle:Producto:disponibilidadAlimentacion.html.twig', array(
        'desde' => $desde,
        'hasta' => $hasta,
        'id'=> $id,
        'servicio'=> $servicio,
        'producto' => $producto,
        'formulario' => $formulario->createView()
        ));
    }

    public function excursionDisponibleAction($id, $producto)
    {	

    	$peticion = $this->getRequest();
		$disponibleexcu = new DisponibilidadExcu();
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new ExcursionDisponibleType(), $disponibleexcu);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
 								
				$em = $this->getDoctrine()->getEntityManager();
				$servicio = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);
				$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);
				$disponibleexcu->setIdServExcu($servicio);
				$em->persist($disponibleexcu);
				$em->flush();
				$this->get('session')->setFlash('info', 'La disponibilidad se a actualizado satisfactoriamente');
				return $this->redirect($this->generateUrl('disponible_Excursion', array('id' => $id,
				'producto' => $producto
				)));
			}
		}					


        $em = $this->getDoctrine()->getEntityManager();
        $disponibles = $em->getRepository('ExtranetBundle:Producto')->findDisponibleExcursion($id,'no disponible');
        $servicio = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);
        //echo '<pre>'.print_r($disponibles, true).'</pre>';exit;
        //$arreglofechas = array();
        $desde[]=null;
        $hasta[]=null;
        foreach($disponibles as $disponible)
            {
                $desde[]=date_format($disponible->getDesde(), 'm/d/Y');
                $hasta[]=date_format($disponible->getHasta(), 'm/d/Y');
                //$arreglofechas ='"'.$desde.','.$hasta.'"'; 
                //$salarreglofechas = implode(',',$arreglofechas);              
            }

        
        return $this->render('ExtranetBundle:Producto:disponibilidadExcursion.html.twig', array(
        'desde' => $desde,
        'hasta' => $hasta,
        'id'=> $id,
        'servicio'=> $servicio,
        'producto' => $producto,
        'formulario' => $formulario->createView()
        ));
    }

    public function vehiculoDisponibleAction($id, $producto)
    {	

    	$peticion = $this->getRequest();
		$disponiblevehi = new DisponibilidadVehi();
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new VehiculoDisponibleType(), $disponiblevehi);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
 								
				$em = $this->getDoctrine()->getEntityManager();
				$servicio = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);
				$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);
				$disponiblevehi->setIdServVehi($servicio);
				$em->persist($disponiblevehi);
				$em->flush();
				$this->get('session')->setFlash('info', 'La disponibilidad se a actualizado satisfactoriamente');
				return $this->redirect($this->generateUrl('disponible_Vehiculo', array('id' => $id,
				'producto' => $producto
				)));
			}
		}					


        $em = $this->getDoctrine()->getEntityManager();
        $disponibles = $em->getRepository('ExtranetBundle:Producto')->findDisponibleVehiculo($id,'no disponible');
        $servicio = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);
        //echo '<pre>'.print_r($disponibles, true).'</pre>';exit;
        //$arreglofechas = array();
        $desde[]=null;
        $hasta[]=null;
        foreach($disponibles as $disponible)
            {
                $desde[]=date_format($disponible->getDesde(), 'm/d/Y');
                $hasta[]=date_format($disponible->getHasta(), 'm/d/Y');
                //$arreglofechas ='"'.$desde.','.$hasta.'"'; 
                //$salarreglofechas = implode(',',$arreglofechas);              
            }

        
        return $this->render('ExtranetBundle:Producto:disponibilidadVehiculo.html.twig', array(
        'desde' => $desde,
        'hasta' => $hasta,
        'id'=> $id,
        'servicio'=> $servicio,
        'producto' => $producto,
        'formulario' => $formulario->createView()
        ));
    }

    public function vueloDisponibleAction($id, $producto)
    {	

    	$peticion = $this->getRequest();
		$disponiblevuel = new DisponibilidadVuel();
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new VueloDisponibleType(), $disponiblevuel);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
 								
				$em = $this->getDoctrine()->getEntityManager();
				$servicio = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);
				$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);
				$disponiblevuel->setIdServVuel($servicio);
				$em->persist($disponiblevuel);
				$em->flush();
				$this->get('session')->setFlash('info', 'La disponibilidad se a actualizado satisfactoriamente');
				return $this->redirect($this->generateUrl('disponible_Vuelo', array('id' => $id,
				'producto' => $producto
				)));
			}
		}					


        $em = $this->getDoctrine()->getEntityManager();
        $disponibles = $em->getRepository('ExtranetBundle:Producto')->findDisponibleVuelo($id,'no disponible');
        $servicio = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);
        //echo '<pre>'.print_r($disponibles, true).'</pre>';exit;
        //$arreglofechas = array();
        $desde[]=null;
        $hasta[]=null;
        foreach($disponibles as $disponible)
            {
                $desde[]=date_format($disponible->getDesde(), 'm/d/Y');
                $hasta[]=date_format($disponible->getHasta(), 'm/d/Y');
                //$arreglofechas ='"'.$desde.','.$hasta.'"'; 
                //$salarreglofechas = implode(',',$arreglofechas);              
            }

        
        return $this->render('ExtranetBundle:Producto:disponibilidadVuelo.html.twig', array(
        'desde' => $desde,
        'hasta' => $hasta,
        'id'=> $id,
        'servicio'=> $servicio,
        'producto' => $producto,
        'formulario' => $formulario->createView()
        ));
    }

    public function LimpiarDisponibilidadAction($id,$tipo)
	{
		
		if($tipo=='Alojamiento'){
		$em = $this->getDoctrine()->getEntityManager();
		$connection = $em->getConnection();
		$platform   = $connection->getDatabasePlatform();
		$connection->executeUpdate($platform->getTruncateTableSQL('disponibilidad_alo'/*,true para cascada*/));
		$this->get('session')->setFlash('info', 'Se reinicio la disponibilidad del producto');

		return $this->redirect($this->generateUrl('producto_verdetalles', array('id' => $id)));
		}

		if($tipo=='Alimentacion'){
		$em = $this->getDoctrine()->getEntityManager();
		$connection = $em->getConnection();
		$platform   = $connection->getDatabasePlatform();
		$connection->executeUpdate($platform->getTruncateTableSQL('disponibilidad_alim'/*,true para cascada*/));
		$this->get('session')->setFlash('info', 'Se reinicio la disponibilidad del producto');

		return $this->redirect($this->generateUrl('producto_verdetalles', array('id' => $id)));
		}

		if($tipo=='Ecodestino'){
		$em = $this->getDoctrine()->getEntityManager();
		$connection = $em->getConnection();
		$platform   = $connection->getDatabasePlatform();
		$connection->executeUpdate($platform->getTruncateTableSQL('disponibilidad_excu'/*,true para cascada*/));
		$this->get('session')->setFlash('info', 'Se reinicio la disponibilidad del producto');

		return $this->redirect($this->generateUrl('producto_verdetalles', array('id' => $id)));
		}

		if($tipo=='Transporte'){
		$em = $this->getDoctrine()->getEntityManager();
		$connection = $em->getConnection();
		$platform   = $connection->getDatabasePlatform();
		$connection->executeUpdate($platform->getTruncateTableSQL('disponibilidad_vehi'/*,true para cascada*/));
		$this->get('session')->setFlash('info', 'Se reinicio la disponibilidad del producto');

		return $this->redirect($this->generateUrl('producto_verdetalles', array('id' => $id)));
		}

		if($tipo=='Vuelo'){
		$em = $this->getDoctrine()->getEntityManager();
		$connection = $em->getConnection();
		$platform   = $connection->getDatabasePlatform();
		$connection->executeUpdate($platform->getTruncateTableSQL('disponibilidad_vuel'/*,true para cascada*/));
		$this->get('session')->setFlash('info', 'Se reinicio la disponibilidad del producto');

		return $this->redirect($this->generateUrl('producto_verdetalles', array('id' => $id)));
		}


	}


	public function actualizaRetiraAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$proveedor = $this->get('security.context')->getToken()->getUser();
		$productos = $em->getRepository('ExtranetBundle:Producto')->findProductos($proveedor->getIdproveedor());
		
		return $this->render('ExtranetBundle:Producto:actualizarRetirar.html.twig', array('productos' => $productos));
	}


	public function actualizaRetiraServicioAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($id);
		$alojamiento = $em->getRepository('ExtranetBundle:Producto')->findSerAlojByProducto($id);
		$alimentacion = $em->getRepository('ExtranetBundle:Producto')->findSerAlimByProducto($id);
		$excursion = $em->getRepository('ExtranetBundle:Producto')->findSerExcurByProducto($id);
		$vehiculo = $em->getRepository('ExtranetBundle:Producto')->findSerVehicByProducto($id);
		$vuelo = $em->getRepository('ExtranetBundle:Producto')->findSerVuelByProducto($id);



		$paginator  = $this->get('knp_paginator');
		$pagalojamiento = $paginator->paginate( $alojamiento, $this->get('request')->query->get('page', 1), 12);
		$pagalimentacion = $paginator->paginate( $alimentacion, $this->get('request')->query->get('page', 1), 12);
		$pagexcursion = $paginator->paginate( $excursion, $this->get('request')->query->get('page', 1), 12);
		$pagvehiculo = $paginator->paginate( $vehiculo, $this->get('request')->query->get('page', 1), 12);
		$pagvuelo = $paginator->paginate( $vuelo, $this->get('request')->query->get('page', 1), 12);


		return $this->render('ExtranetBundle:Producto:actualizaRetiraServicio.html.twig', 
			array(
					'producto' => $producto,
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


    public function actualizarProductoAction($id)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($id);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$producto = $em->getRepository('ExtranetBundle:Producto')->find($id);
				$nomproducto = $producto->getNombre();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomproducto);
				$solicitud->setSolicitud('Solicitud actualizacion producto');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de actualizacion de producto se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudActualizacionProducto.html.twig', array(
		'formulario' => $formulario->createView(),
		'producto' => $producto)); 	
	}
	

	public function retirarProductoAction($id)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($id);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		$proveedor = $this->get('security.context')->getToken()->getUser();

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$producto = $em->getRepository('ExtranetBundle:Producto')->find($id);
				$nomproducto = $producto->getNombre();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomproducto);
				$solicitud->setSolicitud('Solicitud retiro producto');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de retiro de producto se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudRetiroProducto.html.twig', array(
		'formulario' => $formulario->createView(),
		'producto' => $producto)); 	
	}


	 public function actualizarAlojamientoAction($id, $producto)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$servicio = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);
				$nomservicio = $servicio->getTipoAlojamiento();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomservicio);
				$solicitud->setSolicitud('Solicitud actualizacion alojamiento');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de actualizacion de alojamiento se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudActualizacionAlojamiento.html.twig', array(
		'formulario' => $formulario->createView(),
		'servicio' => $servicio,
		'producto' => $producto)); 	
	}

	public function retirarAlojamientoAction($id, $producto)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		$proveedor = $this->get('security.context')->getToken()->getUser();

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$servicio = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);
				$nomservicio = $servicio->getTipoAlojamiento();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomservicio);
				$solicitud->setSolicitud('Solicitud retiro alojamiento');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de retiro de alojamiento se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudRetiroAlojamiento.html.twig', array(
		'formulario' => $formulario->createView(),
		'servicio' => $servicio,
		'producto' => $producto)); 	
	}



	 public function actualizarAlimentacionAction($id, $producto)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$servicio = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);
				$nomservicio = $servicio->getNombre();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomservicio);
				$solicitud->setSolicitud('Solicitud actualizacion alimentacion');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de actualizacion de alimentacion se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudActualizacionAlimentacion.html.twig', array(
		'formulario' => $formulario->createView(),
		'servicio' => $servicio,
		'producto' => $producto)); 	
	}

	public function retirarAlimentacionAction($id, $producto)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		$proveedor = $this->get('security.context')->getToken()->getUser();

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$servicio = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);
				$nomservicio = $servicio->getNombre();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomservicio);
				$solicitud->setSolicitud('Solicitud retiro alimentacion');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de retiro de alimentacion se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudRetiroAlimentacion.html.twig', array(
		'formulario' => $formulario->createView(),
		'servicio' => $servicio,
		'producto' => $producto)); 	
	}


	public function actualizarExcursionAction($id, $producto)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$servicio = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);
				$nomservicio = $servicio->getNombre();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomservicio);
				$solicitud->setSolicitud('Solicitud actualizacion excursion');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de actualizacion de excursion se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudActualizacionExcursion.html.twig', array(
		'formulario' => $formulario->createView(),
		'servicio' => $servicio,
		'producto' => $producto)); 	
	}

	public function retirarExcursionAction($id, $producto)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		$proveedor = $this->get('security.context')->getToken()->getUser();

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$servicio = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);
				$nomservicio = $servicio->getNombre();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomservicio);
				$solicitud->setSolicitud('Solicitud retiro excursion');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de retiro de excursion se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudRetiroExcursion.html.twig', array(
		'formulario' => $formulario->createView(),
		'servicio' => $servicio,
		'producto' => $producto)); 	
	}


	public function actualizarVehiculoAction($id, $producto)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$servicio = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);
				$nomservicio = $servicio->getTipo();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomservicio);
				$solicitud->setSolicitud('Solicitud actualizacion vehiculo');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de actualizacion de vehiculo se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudActualizacionVehiculo.html.twig', array(
		'formulario' => $formulario->createView(),
		'servicio' => $servicio,
		'producto' => $producto)); 	
	}

	public function retirarVehiculoAction($id, $producto)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		$proveedor = $this->get('security.context')->getToken()->getUser();

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$servicio = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);
				$nomservicio = $servicio->getTipo();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomservicio);
				$solicitud->setSolicitud('Solicitud retiro vehiculo');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de retiro de vehiculo se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudRetiroVehiculo.html.twig', array(
		'formulario' => $formulario->createView(),
		'servicio' => $servicio,
		'producto' => $producto)); 	
	}


	public function actualizarVueloAction($id, $producto)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$servicio = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);
				$nomservicio = $servicio->getCompania();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomservicio);
				$solicitud->setSolicitud('Solicitud actualizacion vuelo');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de actualizacion de vuelo se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudActualizacionVuelo.html.twig', array(
		'formulario' => $formulario->createView(),
		'servicio' => $servicio,
		'producto' => $producto)); 	
	}

	public function retirarVueloAction($id, $producto)
	{
		$peticion = $this->getRequest();
		$solicitud = new solicitudes();
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);
		$producto = $em->getRepository('ExtranetBundle:Producto')->find($producto);

		$formulario = $this->createForm(new SolicitudType(), $solicitud);
		$proveedor = $this->get('security.context')->getToken()->getUser();

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {


				$proveedor = $this->get('security.context')->getToken()->getUser();
				$idproveedor = $proveedor->getIdproveedor();
				$nomproveedor = $proveedor->getNombres().' '.$proveedor->getApellidos();
				$servicio = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);
				$nomservicio = $servicio->getCompania();
 								
				$solicitud->setSolicitante($idproveedor);
				$solicitud->setNomsolicitante($nomproveedor);
				$solicitud->setIdElemento($id);
				$solicitud->setNomelemento($nomservicio);
				$solicitud->setSolicitud('Solicitud retiro vuelo');
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($solicitud);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu Solicitud de retiro de vuelo se a creado satisfactorimente');
				return $this->redirect($this->generateUrl('portadap'));
			}
		}					
		return $this->render('ExtranetBundle:Producto:solicitudRetiroVuelo.html.twig', array(
		'formulario' => $formulario->createView(),
		'servicio' => $servicio,
		'producto' => $producto)); 	
	}




	public function quitarServicioAlojamientoAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);
		
		if (!$servicio) {
                throw $this->createNotFoundException('error.');
            }

		$em->remove($servicio);
        $em->flush();
		$this->get('session')->setFlash('info', 'El servicio se ha borrado satisfactorimente');
		return $this->redirect($this->generateUrl('portadap'));
	}


	public function quitarServicioAlimentacionAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);
		
		if (!$servicio) {
                throw $this->createNotFoundException('error.');
            }

		$em->remove($servicio);
        $em->flush();
		$this->get('session')->setFlash('info', 'El servicio se ha borrado satisfactorimente');
		return $this->redirect($this->generateUrl('portadap'));
	}

	public function quitarServicioExcursionAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);
		
		if (!$servicio) {
                throw $this->createNotFoundException('error.');
            }

		$em->remove($servicio);
        $em->flush();
		$this->get('session')->setFlash('info', 'El servicio se ha borrado satisfactorimente');
		return $this->redirect($this->generateUrl('portadap'));
	}

	public function quitarServicioVehiculoAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);
		
		if (!$servicio) {
                throw $this->createNotFoundException('error.');
            }

		$em->remove($servicio);
        $em->flush();
		$this->get('session')->setFlash('info', 'El servicio se ha borrado satisfactorimente');
		return $this->redirect($this->generateUrl('portadap'));
	}

	public function quitarServicioVueloAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$servicio = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);
		
		if (!$servicio) {
                throw $this->createNotFoundException('error.');
            }

		$em->remove($servicio);
        $em->flush();
		$this->get('session')->setFlash('info', 'El servicio se ha borrado satisfactorimente');
		return $this->redirect($this->generateUrl('portadap'));
	}

	
	public function reiniciarDispAlojAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$disponibilidad = $em->getRepository('ExtranetBundle:Producto')->findBorrarDidponibilidadaloj($id);

		$em->remove($disponibilidad);
        $em->flush();
		$this->get('session')->setFlash('info', 'La disponibilidad se ha reiniciado satisfactorimente');
		return $this->redirect($this->generateUrl('portadap'));
	}


	public function reiniciarDispAlimAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$disponibilidad = $em->getRepository('ExtranetBundle:Producto')->findBorrarDidponibilidadalim($id);

		$em->remove($disponibilidad);
        $em->flush();
		$this->get('session')->setFlash('info', 'La disponibilidad se ha reiniciado satisfactorimente');
		return $this->redirect($this->generateUrl('portadap'));
	}


	public function reiniciarDispExcuAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$disponibilidad = $em->getRepository('ExtranetBundle:Producto')->findBorrarDidponibilidadexcu($id);

		$em->remove($disponibilidad);
        $em->flush();
		$this->get('session')->setFlash('info', 'La disponibilidad se ha reiniciado satisfactorimente');
		return $this->redirect($this->generateUrl('portadap'));
	}


	public function reiniciarDispVehiAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$disponibilidad = $em->getRepository('ExtranetBundle:Producto')->findBorrarDidponibilidadvehi($id);

		$em->remove($disponibilidad);
        $em->flush();
		$this->get('session')->setFlash('info', 'La disponibilidad se ha reiniciado satisfactorimente');
		return $this->redirect($this->generateUrl('portadap'));
	}


	public function reiniciarDispVuelAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$disponibilidad = $em->getRepository('ExtranetBundle:Producto')->findBorrarDidponibilidadvuel($id);

		$em->remove($disponibilidad);
        $em->flush();
		$this->get('session')->setFlash('info', 'La disponibilidad se ha reiniciado satisfactorimente');
		return $this->redirect($this->generateUrl('portadap'));
	}

}