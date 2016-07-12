<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ServicioAlojamientoRepository extends EntityRepository
{

	public function findtodosaloj($estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioAlojamiento s
		WHERE  s.estado = :estado 
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}	

	public function findserviciosPaloj($idprod, $estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioAlojamiento s
		WHERE  s.productoproducto = :idprod and s.estado = :estado 
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('idprod', $idprod);

		return $consulta->getResult();
	}	

	
    
}