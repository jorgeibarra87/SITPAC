<?php

namespace Sitpac\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Sitpac\FrontendBundle\Entity\PaqueteTuristico;
use Sitpac\BackendBundle\Form\PaqueteTuristicoType;

use Sitpac\ExtranetBundle\Entity\ServicioAlojamiento;
use Sitpac\BackendBundle\Form\ServicioAlojamientoType;

use Sitpac\ExtranetBundle\Entity\ServicioAlimentacion;
use Sitpac\BackendBundle\Form\ServicioAlimentacionType;

use Sitpac\ExtranetBundle\Entity\ServicioExcursion;
use Sitpac\BackendBundle\Form\ServicioExcursionType;

use Sitpac\ExtranetBundle\Entity\ServicioVehiculo;
use Sitpac\BackendBundle\Form\ServicioVehiculoType;

use Sitpac\ExtranetBundle\Entity\ServicioVuelo;
use Sitpac\BackendBundle\Form\ServicioVueloType;

use Sitpac\ExtranetBundle\Form\SolicitudrespuestaType;

use Sitpac\ExtranetBundle\Form\PqrrespuestaType;


class AdministradorController extends Controller
{
	
	public function loginAction()
	{
		$peticion = $this->getRequest();
		$sesion = $peticion->getSession();
		$error = $peticion->attributes->get(
		SecurityContext::AUTHENTICATION_ERROR,
		$sesion->get(SecurityContext::AUTHENTICATION_ERROR)
		);
		return $this->render('BackendBundle:Administrador:login.html.twig', array(
		'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
		'error' => $error
		));
	}


	public function paquetespendientesclieteAction()
	{

		$em = $this->getDoctrine()->getManager();
        $paquetesp = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetescliente('Pendiente');

        $paginator  = $this->get('knp_paginator');
        $pagpaquetesp = $paginator->paginate( $paquetesp, $this->get('request')->query->get('page', 1), 20);
        return $this->render('BackendBundle:Gerente:paquetesPendientesc.html.twig',array('paquetesp' => $paquetesp,
        'pagpaquetesp' => $pagpaquetesp
        ));
	}

	public function paquetesaprobadosclieteAction()
	{

		$em = $this->getDoctrine()->getManager();
        $paquetesa = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetescliente('Aprobado');

        $paginator  = $this->get('knp_paginator');
        $pagpaquetesa = $paginator->paginate( $paquetesa, $this->get('request')->query->get('page', 1), 20);
        return $this->render('BackendBundle:Gerente:paquetesAprobadosc.html.twig',array('paquetesa' => $paquetesa,
        'pagpaquetesa' => $pagpaquetesa
        ));
	}


	public function paquetespendientesoperadorAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$paquetesp = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetesoperador('Pendiente');

		return $this->render('BackendBundle:Gerente:paquetesPendienteso.html.twig',array('paquetesp' => $paquetesp));
	}

	public function paquetesaprobadosoperadorAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$paquetesa = $em->getRepository('FrontendBundle:PaqueteTuristico')->findPaquetesoperador('Aprobado');

		return $this->render('BackendBundle:Gerente:paquetesAprobadoso.html.twig',array('paquetesa' => $paquetesa));
	}


	public function aprobarPaqueteAction($id)
	{	
		$em = $this->getDoctrine()->getEntityManager();
		$paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);
		$creador = $paquete->getCreadoCliente();

		$paquete->setEstado('Aprobado');

		$em->flush();
		$this->get('session')->setFlash('info', 
		'El paquete cambio su estado a Aprobado');

		if($creador == 1){
			return $this->redirect($this->generateUrl('paquetespendientescliete'));	
		}

		if($creador == 0){
			return $this->redirect($this->generateUrl('paquetespendientesoperador'));	
		}

		
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

		return $this->render('BackendBundle:Gerente:detallesPaquete.html.twig', 
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

        return $this->render('BackendBundle:Gerente:detallesPaqueteo.html.twig', 
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


    public function verservicioalojAction($nombre, $idproducto, $paquete)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
        $servicioaloj = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioaloj($nombre, $idproducto);

        return $this->render('BackendBundle:Gerente:servicioaloj.html.twig',array('servicioaloj' => $servicioaloj,
        'paquete' => $paquete
        ));
    }


    public function verservicioalimAction($nombre, $idproducto, $paquete)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
        $servicioalim = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioalim($nombre, $idproducto);

        return $this->render('BackendBundle:Gerente:servicioalim.html.twig',array('servicioalim' => $servicioalim,
        'paquete' => $paquete
        ));
    }


    public function verservicioexcuAction($nombre, $idproducto, $paquete)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
        $servicioexcu = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioexcu($nombre, $idproducto);

        return $this->render('BackendBundle:Gerente:servicioexcu.html.twig',array('servicioexcu' => $servicioexcu,
        'paquete' => $paquete
        ));
    }


    public function verserviciovehiAction($nombre, $idproducto, $paquete)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
        $serviciovehi = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovehi($nombre, $idproducto);

        return $this->render('BackendBundle:Gerente:serviciovehi.html.twig',array('serviciovehi' => $serviciovehi,
        'paquete' => $paquete
        ));
    }


    public function verservicivuelAction($nombre, $idproducto, $paquete)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
        $serviciovuel = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovuel($nombre, $idproducto);

        return $this->render('BackendBundle:Gerente:serviciovuel.html.twig',array('serviciovuel' => $serviciovuel,
        'paquete' => $paquete
        ));
    }




    public function verservicioalojoperadorAction($nombre, $idproducto, $paquete)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
        $servicioaloj = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioaloj($nombre, $idproducto);

        return $this->render('BackendBundle:Gerente:verservicioaloj.html.twig',array('servicioaloj' => $servicioaloj,
        'paquete' => $paquete
        ));
    }


    public function verservicioalimoperadorAction($nombre, $idproducto, $paquete)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
        $servicioalim = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioalim($nombre, $idproducto);

        return $this->render('BackendBundle:Gerente:verservicioalim.html.twig',array('servicioalim' => $servicioalim,
        'paquete' => $paquete
        ));
    }


    public function verservicioexcuoperadorAction($nombre, $idproducto, $paquete)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
        $servicioexcu = $em->getRepository('FrontendBundle:PaqueteTuristico')->findservicioexcu($nombre, $idproducto);

        return $this->render('BackendBundle:Gerente:verservicioexcu.html.twig',array('servicioexcu' => $servicioexcu,
        'paquete' => $paquete
        ));
    }


    public function verserviciovehioperadorAction($nombre, $idproducto, $paquete)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
        $serviciovehi = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovehi($nombre, $idproducto);

        return $this->render('BackendBundle:Gerente:verserviciovehi.html.twig',array('serviciovehi' => $serviciovehi,
        'paquete' => $paquete
        ));
    }


    public function verservicivueloperadorAction($nombre, $idproducto, $paquete)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paquete = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($paquete);
        $serviciovuel = $em->getRepository('FrontendBundle:PaqueteTuristico')->findserviciovuel($nombre, $idproducto);

        return $this->render('BackendBundle:Gerente:verserviciovuel.html.twig',array('serviciovuel' => $serviciovuel,
        'paquete' => $paquete
        ));
    }







	public function proveedorespendientesAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$provp = $em->getRepository('ExtranetBundle:Proveedor')->findProveedores('Pendiente');

		return $this->render('BackendBundle:Gerente:provpendientes.html.twig',array('provp' => $provp));
	}

	public function proveedoresaprobadosAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$prova = $em->getRepository('ExtranetBundle:Proveedor')->findProveedores('Aprobado');

		return $this->render('BackendBundle:Gerente:provaprobados.html.twig',array('prova' => $prova));
	}


	public function aprobarProveedorAction($id)
	{	
		$em = $this->getDoctrine()->getEntityManager();
		$proveedor = $em->getRepository('ExtranetBundle:Proveedor')->find($id);

		$proveedor->setEstado('Aprobado');

		$em->flush();
		$this->get('session')->setFlash('info', 
		'El proveedor cambio su estado a aprobado');

		return $this->redirect($this->generateUrl('proveedorespendientes'));
	}

	public function productospendientesAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$prodp = $em->getRepository('ExtranetBundle:Producto')->findProductosestado('Pendiente');

		return $this->render('BackendBundle:Gerente:prodpendientes.html.twig',array('prodp' => $prodp));
	}

	public function productosaprobadosAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$proda = $em->getRepository('ExtranetBundle:Producto')->findProductosestado('Aprobado');

		return $this->render('BackendBundle:Gerente:prodaprobados.html.twig',array('proda' => $proda));
	}

	public function AprobarProductoAction($id)
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

        $producto->setEstado('Aprobado');
        if ($alojamiento != null) {
            foreach($alojamiento as $aloj)
            {
                $aloj->setEstado('Aprobado');
            }
            
        }
        if ($alimentacion != null) {
            foreach($alimentacion as $alim)
            {
                $alim->setEstado('Aprobado');
            }
        }
        if ($excursion != null) {
            foreach($excursion as $excu)
            {
                $excu->setEstado('Aprobado');
            }
        }
        if ($vehiculo != null) {
            foreach($vehiculo as $vehi)
            {
                $vehi->setEstado('Aprobado');
            }
        }
        if ($vuelo != null) {
            foreach($vuelo as $vuel)
            {
                $vuel->setEstado('Aprobado');
            }
        }

        $em->flush();
        $this->get('session')->setFlash('info', 
        'El producto cambio su estado a Aprobado');

		return $this->redirect($this->generateUrl('productospendientes'));
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

        return $this->render('BackendBundle:Gerente:detallesproducto.html.twig', 
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


    public function vermasAlojamientoAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $alojamiento = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);

        return $this->render('BackendBundle:Gerente:vermasAlojamiento.html.twig',array('alojamiento' => $alojamiento));
    }
    public function vermasAlimentacionAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $alimentacion = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);

        return $this->render('BackendBundle:Gerente:vermasAlimentacion.html.twig',array('alimentacion' => $alimentacion));
    }
    public function vermasExcursionAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $excursion = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);

        return $this->render('BackendBundle:Gerente:vermasExcursion.html.twig',array('excursion' => $excursion));
    }
    public function vermasVehiculoAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $vehiculo = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);

        return $this->render('BackendBundle:Gerente:vermasVehiculo.html.twig',array('vehiculo' => $vehiculo));
    }
    public function vermasVueloAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $vuelo = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);

        return $this->render('BackendBundle:Gerente:vermasVuelo.html.twig',array('vuelo' => $vuelo));
    }


    public function verTodasSolicitudespgAction()
    {
        $em = $this->getDoctrine()->getEntityManager(); 
        $solicitudes = $em->getRepository('ExtranetBundle:Producto')->findSolicitudestado('Pendiente');
        $paginator  = $this->get('knp_paginator');
        $pagsolicitudes = $paginator->paginate( $solicitudes, $this->get('request')->query->get('page', 1), 20);

        return $this->render('BackendBundle:Gerente:verTodasSolicitudespg.html.twig', array('solicitudes' => $solicitudes,
        'pagsolicitudes' => $pagsolicitudes
        ));
    }

    public function verTodasSolicitudesagAction()
    {
        $em = $this->getDoctrine()->getEntityManager(); 
        $solicitudes = $em->getRepository('ExtranetBundle:Producto')->findSolicitudestado('Aprobada');
        $paginator  = $this->get('knp_paginator');
        $pagsolicitudes = $paginator->paginate( $solicitudes, $this->get('request')->query->get('page', 1), 20);

        return $this->render('BackendBundle:Gerente:verTodasSolicitudesag.html.twig', array('solicitudes' => $solicitudes,
        'pagsolicitudes' => $pagsolicitudes
        ));
    }


    public function vermasSolicitudesgAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $solicitud = $em->getRepository('ExtranetBundle:solicitudes')->find($id);

        return $this->render('BackendBundle:Gerente:vermasSolicitudesg.html.twig', array('solicitud' => $solicitud));
    }


    public function respuestasolicitudgAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $solicitud = $em->getRepository('ExtranetBundle:solicitudes')->find($id);

        $peticion = $this->getRequest();
        $formulario = $this->createForm(new SolicitudrespuestaType(), $solicitud);

        if ($peticion->getMethod() == 'POST') {

            $formulario->bind($peticion);
            
            if ($formulario->isValid()) {       
                
                $em = $this->getDoctrine()->getEntityManager();
                $solicitud->setEstado('Aprobada');
                $em->persist($solicitud);
                $em->flush();
                $this->get('session')->setFlash('info', 'Su respuesta se agrego y la solicitud cambio su estado a Aprobada');
                return $this->redirect( $this->generateUrl('ver_solicitudespg'));
            }
        }

        return $this->render('BackendBundle:Gerente:respuestasolicitudg.html.twig', array('solicitud' => $solicitud,
        'formulario' => $formulario->createView()));
    }






	public function todoslospaquetesAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findAll();

		return $this->render('BackendBundle:Administrador:paquetes.html.twig',array('paquetes' => $paquetes));
	}

	public function paqueteNuevoAction()
	{
		$peticion = $this->getRequest();
		$paquete = new PaqueteTuristico();

		$formulario = $this->createForm(new PaqueteTuristicoType(), $paquete);

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($paquete);
				$em->flush();
				$this->get('session')->setFlash('info', 'Tu nuevo paquete se a creado satisfactoriamente');
				return $this->redirect($this->generateUrl('portadag'));
			}
		}
		return $this->render('BackendBundle:Administrador:paqueteNuevo.html.twig', array(
		'accion' => 'crear',
		'formulario' => $formulario->createView()));
	}

	public function portadaaAction()
	{
		
		$em = $this->getDoctrine()->getEntityManager();
		$paquetes = $em->getRepository('FrontendBundle:PaqueteTuristico')->findAll();

		return $this->render('BackendBundle:Administrador:portada.html.twig',array('paquetes' => $paquetes));
	}



	public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaqueteTuristico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new PaqueteTuristico entity.
     *
     */
    public function newAction()
    {
        $entity = new PaqueteTuristico();
        $form   = $this->createForm(new PaqueteTuristicoType(), $entity);

        return $this->render('BackendBundle:Administrador:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new PaqueteTuristico entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new PaqueteTuristico();
        $form = $this->createForm(new PaqueteTuristicoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paquete_show', array('id' => $entity->getId())));
        }

        return $this->render('BackendBundle:Administrador:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PaqueteTuristico entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaqueteTuristico entity.');
        }

        $editForm = $this->createForm(new PaqueteTuristicoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing PaqueteTuristico entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaqueteTuristico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PaqueteTuristicoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paquete_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Administrador:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PaqueteTuristico entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PaqueteTuristico entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paquete'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    public function todoslosserviciosalojamientoAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$serviciosalojamiento = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->findAll();

		return $this->render('BackendBundle:Administrador:serviciosalojamiento.html.twig',array('serviciosalojamiento' => $serviciosalojamiento));
	}

	public function alojamientoshowAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alojamiento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:alojamientoshow.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    public function alojamientonewAction()
    {
        $entity = new ServicioAlojamiento();
        $form   = $this->createForm(new ServicioAlojamientoType(), $entity);

        return $this->render('BackendBundle:Administrador:alojamientonew.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function alojamientocreateAction(Request $request)
    {
        $entity  = new ServicioAlojamiento();
        $form = $this->createForm(new ServicioAlojamientoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alojamiento_show', array('id' => $entity->getId())));
        }

        return $this->render('BackendBundle:Administrador:alojamientonew.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function alojamientoeditAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alojamiento entity.');
        }

        $editForm = $this->createForm(new ServicioAlojamientoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:alojamientoedit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function alojamientoupdateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alojamiento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ServicioAlojamientoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alojamiento_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Administrador:alojamientoedit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function alojamientodeleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetBundle:ServicioAlojamiento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Alojamiento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('todoslosserviciosalojamiento'));
    }




    public function todoslosserviciosalimentacionAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$serviciosalimentacion = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->findAll();

		return $this->render('BackendBundle:Administrador:serviciosalimentacion.html.twig',array('serviciosalimentacion' => $serviciosalimentacion));
	}

	public function alimentacionshowAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find alimentacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:alimentacionshow.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }


    public function alimentacionnewAction()
    {
        $entity = new ServicioAlimentacion();
        $form   = $this->createForm(new ServicioAlimentacionType(), $entity);

        return $this->render('BackendBundle:Administrador:alimentacionnew.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function alimentacioncreateAction(Request $request)
    {
        $entity  = new ServicioAlimentacion();
        $form = $this->createForm(new ServicioAlimentacionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alimentacion_show', array('id' => $entity->getId())));
        }

        return $this->render('BackendBundle:Administrador:alimentacionnew.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    public function alimentacioneditAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find alimentacion entity.');
        }

        $editForm = $this->createForm(new ServicioAlimentacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:alimentacionedit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function alimentacionupdateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find alimentacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ServicioAlimentacionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alimentacion_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Administrador:alimentacionedit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function alimentaciondeleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetBundle:ServicioAlimentacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find alimentacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('todoslosserviciosalimentacion'));
    }


    public function todoslosserviciosexcursionAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$serviciosexcursion = $em->getRepository('ExtranetBundle:ServicioExcursion')->findAll();

		return $this->render('BackendBundle:Administrador:serviciosexcursion.html.twig',array('serviciosexcursion' => $serviciosexcursion));
	}


    public function excursionshowAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find excursion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:excursionshow.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    public function excursionnewAction()
    {
        $entity = new ServicioExcursion();
        $form   = $this->createForm(new ServicioExcursionType(), $entity);

        return $this->render('BackendBundle:Administrador:excursionnew.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    public function excursioncreateAction(Request $request)
    {
        $entity  = new ServicioExcursion();
        $form = $this->createForm(new ServicioExcursionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('excursion_show', array('id' => $entity->getId())));
        }

        return $this->render('BackendBundle:Administrador:excursionnew.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    public function excursioneditAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find excursion entity.');
        }

        $editForm = $this->createForm(new ServicioExcursionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:excursionedit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function excursionupdateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find excursion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ServicioExcursionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('excursion_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Administrador:excursionedit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function excursiondeleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetBundle:ServicioExcursion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find excursion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('todoslosserviciosexcursion'));
    }


    public function todoslosserviciosvehiculoAction()
	{

		$em = $this->getDoctrine()->getEntityManager();
		$serviciosvehiculo= $em->getRepository('ExtranetBundle:ServicioVehiculo')->findAll();

		return $this->render('BackendBundle:Administrador:serviciosvehiculo.html.twig',array('serviciosvehiculo' => $serviciosvehiculo));
	}


	public function vehiculoshowAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find vehiculo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:vehiculoshow.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }


    public function vehiculonewAction()
    {
        $entity = new ServicioVehiculo();
        $form   = $this->createForm(new ServicioVehiculoType(), $entity);

        return $this->render('BackendBundle:Administrador:vehiculonew.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function vehiculocreateAction(Request $request)
    {
        $entity  = new ServicioVehiculo();
        $form = $this->createForm(new ServicioVehiculoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vehiculo_show', array('id' => $entity->getId())));
        }

        return $this->render('BackendBundle:Administrador:vehiculonew.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    public function vehiculoeditAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find vehiculo entity.');
        }

        $editForm = $this->createForm(new ServicioVehiculoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:vehiculoedit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function vehiculoupdateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find vehiculo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ServicioVehiculoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vehiculo_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Administrador:vehiculoedit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function vehiculodeleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetBundle:ServicioVehiculo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find vehiculo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('todoslosserviciosvehiculo'));
    }


    public function todoslosserviciosvueloAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $serviciosvuelo = $em->getRepository('ExtranetBundle:ServicioVuelo')->findAll();

        return $this->render('BackendBundle:Administrador:serviciosvuelo.html.twig',array('serviciosvuelo' => $serviciosvuelo));
    }


    public function vueloshowAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find vuelo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:vueloshow.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    public function vuelonewAction()
    {
        $entity = new ServicioVuelo();
        $form   = $this->createForm(new ServicioVueloType(), $entity);

        return $this->render('BackendBundle:Administrador:vuelonew.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function vuelocreateAction(Request $request)
    {
        $entity  = new ServicioVuelo();
        $form = $this->createForm(new ServicioVueloType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vuelo_show', array('id' => $entity->getId())));
        }

        return $this->render('BackendBundle:Administrador:vuelonew.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function vueloeditAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find vuelo entity.');
        }

        $editForm = $this->createForm(new ServicioVueloType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Administrador:vueloedit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function vueloupdateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find vuelo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ServicioVueloType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vuelo_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Administrador:vueloedit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function vuelodeleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ExtranetBundle:ServicioVuelo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find vuelo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('todoslosserviciosvuelo'));
    }

    public function todoslosproveedoresAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $proveedores = $em->getRepository('ExtranetBundle:Proveedor')->findAll();

        return $this->render('BackendBundle:Administrador:proveedores.html.twig',array('proveedores' => $proveedores));
    }


    

    public function todoslosproductosAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $productos = $em->getRepository('ExtranetBundle:Producto')->findAll();

        return $this->render('BackendBundle:Administrador:productos.html.twig',array('productos' => $productos));
    }

    public function vertodaspqrspgAction()
    {
        $em = $this->getDoctrine()->getEntityManager();     
        $peticiones = $em->getRepository('FrontendBundle:Pqr')->findPqrsestado('PQR Pendiente');
        $paginator  = $this->get('knp_paginator');
        $pagpeticiones = $paginator->paginate( $peticiones, $this->get('request')->query->get('page', 1), 20);

        return $this->render('BackendBundle:Gerente:vertodaspqrspg.html.twig', array('peticiones' => $peticiones,
        'pagpeticiones' => $pagpeticiones
        ));
    }


    public function vertodaspqrsagAction()
    {
        $em = $this->getDoctrine()->getEntityManager();     
        $peticiones = $em->getRepository('FrontendBundle:Pqr')->findPqrsestado('PQR Aprobada');
        $paginator  = $this->get('knp_paginator');
        $pagpeticiones = $paginator->paginate( $peticiones, $this->get('request')->query->get('page', 1), 20);

        return $this->render('BackendBundle:Gerente:vertodaspqrsag.html.twig', array('peticiones' => $peticiones,
        'pagpeticiones' => $pagpeticiones
        ));
    }

    public function vermaspqrgAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $peticion = $em->getRepository('FrontendBundle:Pqr')->find($id);

        return $this->render('BackendBundle:Gerente:vermaspqrg.html.twig', array('peticion' => $peticion));
    }

    public function respuestapqrgAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $pqr = $em->getRepository('FrontendBundle:Pqr')->find($id);

        $peticion = $this->getRequest();
        $formulario = $this->createForm(new PqrrespuestaType(), $pqr);

        if ($peticion->getMethod() == 'POST') {

            $formulario->bind($peticion);
            
            if ($formulario->isValid()) {       
                
                $em = $this->getDoctrine()->getEntityManager();
                $pqr->setEstado('PQR Aprobada');
                $em->persist($pqr);
                $em->flush();
                $this->get('session')->setFlash('info', 'Su respuesta se agrego y la pqr cambio su estado a aprobada');
                return $this->redirect( $this->generateUrl('ver_todaspqrspg'));
            }
        }

        return $this->render('BackendBundle:Gerente:respuestapqrg.html.twig', array('pqr' => $pqr,
        'formulario' => $formulario->createView()));
    }


    public function vertodosclientesgAction()
    {
        $em = $this->getDoctrine()->getEntityManager();     
        $clientes = $em->getRepository('FrontendBundle:Cliente')->findtodosclientes();
        $paginator  = $this->get('knp_paginator');
        $pagclientes = $paginator->paginate( $clientes, $this->get('request')->query->get('page', 1), 20);

        return $this->render('BackendBundle:Gerente:vertodosclientesg.html.twig', array('clientes' => $clientes,
        'pagclientes' => $pagclientes
        ));
    }

    public function vertodasreservasgAction()
    {
        $em = $this->getDoctrine()->getEntityManager();;
        $reservas = $em->getRepository('FrontendBundle:Reserva')->findTodasreservas('En Reserva');

        $paginator  = $this->get('knp_paginator');
        $pagreservas = $paginator->paginate( $reservas, $this->get('request')->query->get('page', 1), 20);

        return $this->render('BackendBundle:Gerente:vertodasreservasg.html.twig',array('reservas' => $reservas,
        'pagreservas' => $pagreservas,));
    }

    public function detallesreservagAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $reserva = $em->getRepository('FrontendBundle:Reserva')->find($id);
        $intinerario = $em->getRepository('FrontendBundle:Reserva')->findIntinerarioreserva($id);

        return $this->render('BackendBundle:Gerente:detallesreservag.html.twig',array('reserva' => $reserva,
        'intinerario' => $intinerario,));
        
    }

    public function reservaspagadasgAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $reservas = $em->getRepository('FrontendBundle:Reserva')->findReservasPagas('Pagada');

        $paginator  = $this->get('knp_paginator');
        $pagreservas = $paginator->paginate( $reservas, $this->get('request')->query->get('page', 1), 20);

        return $this->render('BackendBundle:Gerente:reservaspagadasg.html.twig',array('reservas' => $reservas,
        'pagreservas' => $pagreservas,));
    }

    public function detallescompragAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $reserva = $em->getRepository('FrontendBundle:Reserva')->find($id);
        $intinerario = $em->getRepository('FrontendBundle:Reserva')->findIntinerarioreserva($id);

        return $this->render('BackendBundle:Gerente:detallescomprag.html.twig',array('reserva' => $reserva,
        'intinerario' => $intinerario,));
        
    }

}