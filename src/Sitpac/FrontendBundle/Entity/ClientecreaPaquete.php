<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientecreaPaquete
 *
 * @ORM\Table(name="clientecrea_paquete")
 * @ORM\Entity
 */
class ClientecreaPaquete
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idclientecrea_paquete", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idclientecreaPaquete;

    /**
     * @var \PaqueteTuristico
     *
     * @ORM\ManyToOne(targetEntity="PaqueteTuristico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paquete_turistico_idpaquete_turistico", referencedColumnName="idpaquete_turistico")
     * })
     */
    private $idpaqueteTuristico;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_idcliente", referencedColumnName="idcliente")
     * })
     */
    private $idcliente;



    /**
     * Get idclientecreaPaquete
     *
     * @return integer 
     */
    public function getIdclientecreaPaquete()
    {
        return $this->idclientecreaPaquete;
    }

    /**
     * Set paqueteTuristicopaqueteTuristico
     *
     * @param \Sitpac\FrontendBundle\Entity\PaqueteTuristico $paqueteTuristicopaqueteTuristico
     * @return ClientecreaPaquete
     */
    public function setPaqueteTuristicopaqueteTuristico(\Sitpac\FrontendBundle\Entity\PaqueteTuristico $paqueteTuristicopaqueteTuristico = null)
    {
        $this->paqueteTuristicopaqueteTuristico = $paqueteTuristicopaqueteTuristico;
    
        return $this;
    }

    /**
     * Get paqueteTuristicopaqueteTuristico
     *
     * @return \Sitpac\FrontendBundle\Entity\PaqueteTuristico 
     */
    public function getPaqueteTuristicopaqueteTuristico()
    {
        return $this->paqueteTuristicopaqueteTuristico;
    }

    /**
     * Set clientecliente
     *
     * @param \Sitpac\FrontendBundle\Entity\Cliente $clientecliente
     * @return ClientecreaPaquete
     */
    public function setClientecliente(\Sitpac\FrontendBundle\Entity\Cliente $clientecliente = null)
    {
        $this->clientecliente = $clientecliente;
    
        return $this;
    }

    /**
     * Get clientecliente
     *
     * @return \Sitpac\FrontendBundle\Entity\Cliente 
     */
    public function getClientecliente()
    {
        return $this->clientecliente;
    }
}