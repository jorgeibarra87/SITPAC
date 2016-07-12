<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ServicioExcursionRepository extends EntityRepository
{

	public function findtodosexcu($estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioExcursion s
		WHERE  s.estado = :estado  
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}	

	public function findserviciosPexcu($idprod, $estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioExcursion s
		WHERE  s.productoproducto = :idprod and s.estado = :estado 
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('idprod', $idprod);

		return $consulta->getResult();
	}	
    
}