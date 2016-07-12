<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ServicioVehiculoRepository extends EntityRepository
{
	public function findtodosvehi($estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioVehiculo s
		WHERE  s.estado = :estado 
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}

	public function findserviciosPvehi($idprod, $estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioVehiculo s
		WHERE  s.productoproducto = :idprod and s.estado = :estado 
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('idprod', $idprod);

		return $consulta->getResult();
	}		
    
}