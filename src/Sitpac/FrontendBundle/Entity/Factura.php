<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Factura
 *
 * @ORM\Table(name="factura")
 * @ORM\Entity
 */
class Factura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfactura", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfactura;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_emision", type="datetime", nullable=false)
     */
    private $fechaEmision;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cobro", type="datetime", nullable=false)
     */
    private $fechaCobro;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", nullable=false)
     */
    private $valor;

    /**
     * @var float
     *
     * @ORM\Column(name="iva", type="float", nullable=false)
     */
    private $iva;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", nullable=false)
     */
    private $total;

    /**
     * @var \Reserva
     *
     * @ORM\ManyToOne(targetEntity="Reserva")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reserva_idreserva", referencedColumnName="idreserva")
     * })
     */
    private $reservareserva;



    /**
     * Get idfactura
     *
     * @return integer 
     */
    public function getIdfactura()
    {
        return $this->idfactura;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Factura
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaEmision
     *
     * @param \DateTime $fechaEmision
     * @return Factura
     */
    public function setFechaEmision($fechaEmision)
    {
        $this->fechaEmision = $fechaEmision;
    
        return $this;
    }

    /**
     * Get fechaEmision
     *
     * @return \DateTime 
     */
    public function getFechaEmision()
    {
        return $this->fechaEmision;
    }

    /**
     * Set fechaCobro
     *
     * @param \DateTime $fechaCobro
     * @return Factura
     */
    public function setFechaCobro($fechaCobro)
    {
        $this->fechaCobro = $fechaCobro;
    
        return $this;
    }

    /**
     * Get fechaCobro
     *
     * @return \DateTime 
     */
    public function getFechaCobro()
    {
        return $this->fechaCobro;
    }

    /**
     * Set valor
     *
     * @param float $valor
     * @return Factura
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return float 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set iva
     *
     * @param float $iva
     * @return Factura
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    
        return $this;
    }

    /**
     * Get iva
     *
     * @return float 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Factura
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set reservareserva
     *
     * @param \Sitpac\FrontendBundle\Entity\Reserva $reservareserva
     * @return Factura
     */
    public function setReservareserva(\Sitpac\FrontendBundle\Entity\Reserva $reservareserva = null)
    {
        $this->reservareserva = $reservareserva;
    
        return $this;
    }

    /**
     * Get reservareserva
     *
     * @return \Sitpac\FrontendBundle\Entity\Reserva 
     */
    public function getReservareserva()
    {
        return $this->reservareserva;
    }
}