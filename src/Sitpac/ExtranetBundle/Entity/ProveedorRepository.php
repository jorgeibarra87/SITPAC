<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProveedorRepository extends EntityRepository
{

	public function findProveedores($estado, $limite = null)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT p FROM ExtranetBundle:Proveedor p 
		WHERE p.estado = :estado
		ORDER BY p.fechaAlta DESC');
		$consulta->setParameter('estado', $estado);
		if (null != $limite) {
		
			$consulta->setMaxResults($limite);

		}

		return $consulta->getResult();
	}
    
}