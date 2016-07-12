<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * IntinerarioReserva
 *
 * @ORM\Table(name="intinerario_reserva")
 * @ORM\Entity
 */
class IntinerarioReserva
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_intinerario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idIntinerario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_producto", type="string", length=100, nullable=false)
     */
    private $nombreProducto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_servicio", type="string", length=100, nullable=false)
     */
    private $nombreServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="detalles", type="text", nullable=false)
     */
    private $detalles;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion", type="integer", nullable=false)
     */
    private $duracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="datetime", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="datetime", nullable=false)
     */
    private $fechaFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="descuento", type="integer", nullable=false)
     */
    private $descuento;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_servicio", type="float", nullable=false)
     */
    private $precioServicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_proveedor", type="integer", nullable=false)
     */
    private $idProveedor;

    /**
     * @var \Reserva
     *
     * @ORM\ManyToOne(targetEntity="Reserva", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reserva", referencedColumnName="idreserva")
     * })
     */
    private $idReserva;



    /**
     * Get idIntinerario
     *
     * @return integer 
     */
    public function getIdIntinerario()
    {
        return $this->idIntinerario;
    }

    /**
     * Set nombreProducto
     *
     * @param string $nombreProducto
     * @return IntinerarioReserva
     */
    public function setNombreProducto($nombreProducto)
    {
        $this->nombreProducto = $nombreProducto;
    
        return $this;
    }

    /**
     * Get nombreProducto
     *
     * @return string 
     */
    public function getNombreProducto()
    {
        return $this->nombreProducto;
    }

    /**
     * Set nombreServicio
     *
     * @param string $nombreServicio
     * @return IntinerarioReserva
     */
    public function setNombreServicio($nombreServicio)
    {
        $this->nombreServicio = $nombreServicio;
    
        return $this;
    }

    /**
     * Get nombreServicio
     *
     * @return string 
     */
    public function getNombreServicio()
    {
        return $this->nombreServicio;
    }

    /**
     * Set detalles
     *
     * @param string $detalles
     * @return IntinerarioReserva
     */
    public function setDetalles($detalles)
    {
        $this->detalles = $detalles;
    
        return $this;
    }

    /**
     * Get detalles
     *
     * @return string 
     */
    public function getDetalles()
    {
        return $this->detalles;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     * @return IntinerarioReserva
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    
        return $this;
    }

    /**
     * Get duracion
     *
     * @return integer 
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return IntinerarioReserva
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    
        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return IntinerarioReserva
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    
        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set descuento
     *
     * @param integer $descuento
     * @return IntinerarioReserva
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return integer 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set precioServicio
     *
     * @param float $precioServicio
     * @return IntinerarioReserva
     */
    public function setPrecioServicio($precioServicio)
    {
        $this->precioServicio = $precioServicio;
    
        return $this;
    }

    /**
     * Get precioServicio
     *
     * @return float 
     */
    public function getPrecioServicio()
    {
        return $this->precioServicio;
    }

    /**
     * Set idProveedor
     *
     * @param integer $idProveedor
     * @return IntinerarioReserva
     */
    public function setIdProveedor($idProveedor)
    {
        $this->idProveedor = $idProveedor;
    
        return $this;
    }

    /**
     * Get idProveedor
     *
     * @return integer 
     */
    public function getIdProveedor()
    {
        return $this->idProveedor;
    }

    /**
     * Set idReserva
     *
     * @param \Sitpac\FrontendBundle\Entity\Reserva $idReserva
     * @return IntinerarioReserva
     */
    public function setIdReserva(\Sitpac\FrontendBundle\Entity\Reserva $idReserva = null)
    {
        $this->idReserva = $idReserva;
    
        return $this;
    }

    /**
     * Get idReserva
     *
     * @return \Sitpac\FrontendBundle\Entity\Reserva 
     */
    public function getIdReserva()
    {
        return $this->idReserva;
    }

     public function __construct()
    {
        $this->idReserva = new ArrayCollection();
        

    }
}