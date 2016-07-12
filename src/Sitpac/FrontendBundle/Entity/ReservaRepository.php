<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ReservaRepository extends EntityRepository
{
    public function findReservascliente($idcliente,$estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT r FROM FrontendBundle:Reserva r
		WHERE r.clientecliente = :idcliente and r.estado = :estado and r.fechaExpiracion > :now 
		ORDER BY r.fechaReservado DESC,r.estado DESC');
		$consulta->setParameter('idcliente', $idcliente);
		$consulta->setParameter('estado', $estado);
		$consulta->setParameter('now', new \DateTime('-2 days'));

		return $consulta->getResult();
	}

	public function findIntinerarioreserva($idreserva)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT i FROM FrontendBundle:IntinerarioReserva i
		WHERE i.idReserva = :idreserva');
		$consulta->setParameter('idreserva', $idreserva);

		return $consulta->getResult();
	}

	public function findReservasPagascliente($idcliente,$estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT r FROM FrontendBundle:Reserva r
		WHERE r.clientecliente = :idcliente and r.estado = :estado
		ORDER BY r.fechaReservado DESC,r.estado DESC');
		$consulta->setParameter('idcliente', $idcliente);
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}

	public function findreservasservicios($idproveedor,$estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT i,r FROM FrontendBundle:IntinerarioReserva i 
		JOIN i.idReserva r
		WHERE i.idProveedor = :idproveedor and r.estado = :estado
		ORDER BY r.fechaReservado DESC,r.estado DESC');
		$consulta->setParameter('idproveedor', $idproveedor);
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}

	public function findTodasreservas($estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT r FROM FrontendBundle:Reserva r
		WHERE r.estado = :estado and r.fechaExpiracion > :now 
		ORDER BY r.fechaReservado DESC,r.estado DESC');

		$consulta->setParameter('now', new \DateTime('-2 days'));
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}


	public function findReservasPagas($estado)
	{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT r FROM FrontendBundle:Reserva r
		WHERE r.estado = :estado
		ORDER BY r.fechaReservado DESC,r.estado DESC');
		$consulta->setParameter('estado', $estado);

		return $consulta->getResult();
	}
}