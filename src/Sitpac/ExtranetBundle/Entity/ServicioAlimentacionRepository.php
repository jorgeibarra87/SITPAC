<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ServicioAlimentacionRepository extends EntityRepository
{

	public function findtodosalim($estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioAlimentacion s
		WHERE  s.estado = :estado 
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}	

	public function findserviciosPalim($idprod, $estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioAlimentacion s
		WHERE  s.productoproducto = :idprod and s.estado = :estado 
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('idprod', $idprod);

		return $consulta->getResult();
	}	
    
}