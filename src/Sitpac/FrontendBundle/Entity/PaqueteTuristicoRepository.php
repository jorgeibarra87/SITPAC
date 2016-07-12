<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PaqueteTuristicoRepository extends EntityRepository
{


	public function findPaquetesconid($id_paquete, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM FrontendBundle:PaqueteTuristico p 
		WHERE p.idpaqueteTuristico = :id and p.fechaExpiracion > :now ');
		$consulta->setParameter('id', $id_paquete);
		$consulta->setParameter('now', new \DateTime('-2 days'));
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}



	public function findPaquetes($estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM FrontendBundle:PaqueteTuristico p 
		WHERE p.estado = :estado and p.creadocliente = 1 and p.fechaExpiracion > :now
		ORDER BY p.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('now', new \DateTime('-2 days'));
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}

	public function findPaquetesoperador($estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM FrontendBundle:PaqueteTuristico p 
		WHERE p.estado = :estado and p.creadocliente = 0 and p.fechaExpiracion > :now
		ORDER BY p.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('now', new \DateTime('-2 days'));
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}

	public function findPaquetescliente($estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM FrontendBundle:PaqueteTuristico p 
		WHERE p.estado = :estado and p.creadocliente = 1 and p.fechaExpiracion > :now
		ORDER BY p.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('now', new \DateTime('-2 days'));
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findSerAlojByPaquete($paquete_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM FrontendBundle:ServicioPaqAlo s
		WHERE s.paqueteTuristicopaqueteTuristico = :id
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('id', $paquete_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findSerAlimByPaquete($paquete_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM FrontendBundle:ServicioPaqAlim s
		WHERE s.paqueteTuristicopaqueteTuristico = :id
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('id', $paquete_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findSerExcuByPaquete($paquete_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM FrontendBundle:ServicioPaqExcu s
		WHERE s.paqueteTuristicopaqueteTuristico = :id
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('id', $paquete_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findSerVehiByPaquete($paquete_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM FrontendBundle:ServicioPaqVehi s
		WHERE s.paqueteTuristicopaqueteTuristico = :id
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('id', $paquete_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	public function findSerVuelByPaquete($paquete_id, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM FrontendBundle:ServicioPaqVuel s
		WHERE s.paqueteTuristicopaqueteTuristico = :id
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('id', $paquete_id);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}


	
	public function findservicioaloj($nombre, $idproducto)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioAlojamiento s
		WHERE s.tipoAlojamiento = :nombre and s.productoproducto = :idproducto');
		$consulta->setParameter('nombre', $nombre);
		$consulta->setParameter('idproducto', $idproducto);
		

		return $consulta->getResult();
	}


	public function findservicioalim($nombre, $idproducto)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioAlimentacion s
		WHERE s.nombre = :nombre and s.productoproducto = :idproducto');
		$consulta->setParameter('nombre', $nombre);
		$consulta->setParameter('idproducto', $idproducto);
		

		return $consulta->getResult();
	}


	public function findservicioexcu($nombre, $idproducto)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioExcursion s
		WHERE s.nombre = :nombre and s.productoproducto = :idproducto');
		$consulta->setParameter('nombre', $nombre);
		$consulta->setParameter('idproducto', $idproducto);
		

		return $consulta->getResult();
	}


	public function findserviciovehi($nombre, $idproducto)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioVehiculo s
		WHERE s.tipo = :nombre and s.productoproducto = :idproducto');
		$consulta->setParameter('nombre', $nombre);
		$consulta->setParameter('idproducto', $idproducto);
		

		return $consulta->getResult();
	}


	public function findserviciovuel($nombre, $idproducto)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioVuelo s
		WHERE s.compania = :nombre and s.productoproducto = :idproducto');
		$consulta->setParameter('nombre', $nombre);
		$consulta->setParameter('idproducto', $idproducto);
		

		return $consulta->getResult();
	}


	public function findcreadorpaquete($idoperador,$estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM FrontendBundle:PaqueteTuristico p
		WHERE p.creador = :idoperador and p.creadocliente = 0 and p.estado = :estado and p.fechaExpiracion > :now
		ORDER BY p.fechaCreacion DESC');
		$consulta->setParameter('idoperador', $idoperador);
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('now', new \DateTime('-2 days'));

		return $consulta->getResult();
	}



	public function findcreadorpaquetecliente($idcliente,$estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM FrontendBundle:PaqueteTuristico p
		WHERE p.creador = :idcliente and p.creadocliente = 1 and p.estado = :estado and p.fechaExpiracion > :now 
		ORDER BY p.fechaCreacion DESC');
		$consulta->setParameter('idcliente', $idcliente);
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('now', new \DateTime('-2 days'));

		return $consulta->getResult();
	}


	public function findBusquedaPaquetes($municipio, $precio1, $precio2, $estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM FrontendBundle:PaqueteTuristico p
		WHERE p.creadocliente = 0 and p.preciototal >= :precio1 and p.preciototal <= :precio2 
		and p.estado = :estado and p.municipiomunicipio = :municipio and p.fechaExpiracion > :now 
		ORDER BY p.fechaCreacion DESC');
		$consulta->setParameter('precio1', $precio1);
		$consulta->setParameter('precio2', $precio2);
		$consulta->setParameter('municipio', $municipio);
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('now', new \DateTime('-2 days'));

		return $consulta->getResult();
	}
		
    
}