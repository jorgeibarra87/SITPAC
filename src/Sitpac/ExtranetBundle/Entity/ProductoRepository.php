<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProductoRepository extends EntityRepository
{

	public function findProductos($proveedor_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT pd, pv FROM ExtranetBundle:Producto pd JOIN pd.proveedorproveedor pv
		WHERE pd.proveedorproveedor = :id
		ORDER BY pd.fechaCreacion DESC');
		$consulta->setParameter('id', $proveedor_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findSerAlojByProducto($producto_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s, p FROM ExtranetBundle:ServicioAlojamiento s JOIN s.productoproducto p
		WHERE s.productoproducto = :id
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('id', $producto_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findSerAlimByProducto($producto_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s, p FROM ExtranetBundle:ServicioAlimentacion s JOIN s.productoproducto p
		WHERE s.productoproducto = :id
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('id', $producto_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findSerExcurByProducto($producto_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s, p FROM ExtranetBundle:ServicioExcursion s JOIN s.productoproducto p
		WHERE s.productoproducto = :id
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('id', $producto_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findSerVehicByProducto($producto_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s, p FROM ExtranetBundle:ServicioVehiculo s JOIN s.productoproducto p
		WHERE s.productoproducto = :id
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('id', $producto_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findSerVuelByProducto($producto_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s, p FROM ExtranetBundle:ServicioVuelo s JOIN s.productoproducto p
		WHERE s.productoproducto = :id
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('id', $producto_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findProductosestado($estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM ExtranetBundle:Producto p
		WHERE p.estado = :estado
		ORDER BY p.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}

	public function findProductoservicios($estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM ExtranetBundle:Producto p
		WHERE p.estado = :estado
		ORDER BY p.tipoProducto ASC, p.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}

	public function findDisponibleAlimentacion($servicio_id, $estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT d, s FROM ExtranetBundle:DisponibilidadAlim d JOIN d.idServAlim s
		WHERE d.idServAlim = :id and d.estado = :estado
		');
		$consulta->setParameter('id', $servicio_id);
		$consulta->setParameter('estado', $estado);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}

	public function findDisponibleAlojamiento($servicio_id, $estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT d, s FROM ExtranetBundle:DisponibilidadAlo d JOIN d.idServAlo s
		WHERE d.idServAlo = :id and d.estado = :estado
		');
		$consulta->setParameter('id', $servicio_id);
		$consulta->setParameter('estado', $estado);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}

	public function findDisponibleExcursion($servicio_id, $estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT d, s FROM ExtranetBundle:DisponibilidadExcu d JOIN d.idServExcu s
		WHERE d.idServExcu = :id and d.estado = :estado
		');
		$consulta->setParameter('id', $servicio_id);
		$consulta->setParameter('estado', $estado);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}

	public function findDisponibleVehiculo($servicio_id, $estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT d, s FROM ExtranetBundle:DisponibilidadVehi d JOIN d.idServVehi s
		WHERE d.idServVehi = :id and d.estado = :estado
		');
		$consulta->setParameter('id', $servicio_id);
		$consulta->setParameter('estado', $estado);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}

	public function findDisponibleVuelo($servicio_id, $estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT d, s FROM ExtranetBundle:DisponibilidadVuel d JOIN d.idServVuel s
		WHERE d.idServVuel = :id and d.estado = :estado
		');
		$consulta->setParameter('id', $servicio_id);
		$consulta->setParameter('estado', $estado);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findTipoProductos($tipoproducto, $estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM ExtranetBundle:Producto p
		WHERE p.tipoProducto = :tipoproducto and p.estado = :estado
		ORDER BY p.fechaCreacion DESC');
		$consulta->setParameter('tipoproducto', $tipoproducto);
		$consulta->setParameter('estado', $estado);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findBorrarDidponibilidadaloj($servicio_id)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		DELETE ExtranetBundle:DisponibilidadAlo d WHERE d.idServAlo = :id ');
		$consulta->setParameter('id', $servicio_id);

		return $consulta->getResult();
	}


	public function findBorrarDidponibilidadalim($servicio_id)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		DELETE ExtranetBundle:DisponibilidadAlim d WHERE d.idServAlim = :id ');
		$consulta->setParameter('id', $servicio_id);

		return $consulta->getResult();
	}


	public function findBorrarDidponibilidadexcu($servicio_id)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		DELETE ExtranetBundle:DisponibilidadExcu d WHERE d.idServExcu = :id ');
		$consulta->setParameter('id', $servicio_id);

		return $consulta->getResult();
	}


	public function findBorrarDidponibilidadvehi($servicio_id)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		DELETE ExtranetBundle:DisponibilidadVehi d WHERE d.idServVehi = :id ');
		$consulta->setParameter('id', $servicio_id);

		return $consulta->getResult();
	}


	public function findBorrarDidponibilidadvuel($servicio_id)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		DELETE ExtranetBundle:DisponibilidadVuel d WHERE d.idServVuel = :id ');
		$consulta->setParameter('id', $servicio_id);

		return $consulta->getResult();
	}


	public function findTodasSolicitudes($user_id)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:Solicitudes s
		WHERE s.solicitante = :userid
		ORDER BY s.estado ASC');
		$consulta->setParameter('userid', $user_id);

		return $consulta->getResult();
	}

	public function findSolicitudestado($estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:Solicitudes s
		WHERE s.estado = :estado
		ORDER BY s.fecha DESC');
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}
    
}