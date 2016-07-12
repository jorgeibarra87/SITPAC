<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ClienteRepository extends EntityRepository
{
    public function findtodosclientes()
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT c FROM FrontendBundle:Cliente c
		ORDER BY c.fechaAlta DESC');		

		return $consulta->getResult();
	}
}