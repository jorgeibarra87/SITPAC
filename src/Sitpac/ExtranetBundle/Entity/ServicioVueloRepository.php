<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ServicioVueloRepository extends EntityRepository
{
	public function findtodosvuel($estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioVuelo s
		WHERE  s.estado = :estado 
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}

	public function findserviciosPvuel($idprod, $estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT s FROM ExtranetBundle:ServicioVuelo s
		WHERE  s.productoproducto = :idprod and s.estado = :estado 
		ORDER BY s.fechaCreacion DESC');
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('idprod', $idprod);

		return $consulta->getResult();
	}		
    
}