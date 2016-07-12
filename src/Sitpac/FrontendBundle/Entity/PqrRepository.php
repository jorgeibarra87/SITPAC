<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PqrRepository extends EntityRepository
{

	public function findTodasPqrs($user_id)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM FrontendBundle:Pqr p
		WHERE p.clientecliente = :userid
		ORDER BY p.fecha DESC');
		$consulta->setParameter('userid', $user_id);

		return $consulta->getResult();
	}

	public function findPqrsestado($estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM FrontendBundle:Pqr p
		WHERE p.estado = :estado
		ORDER BY p.fecha DESC');
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}
		
    
}