<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ServicioPaqAlo
 *
 * @ORM\Table(name="servicio_paq_alo")
 * @ORM\Entity
 */
class ServicioPaqAlo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idservicio_paq_alo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idservicioPaqAlo;

    /**
     * @var string
     *
     * @ORM\Column(name="fotoservicio", type="string", length=255, nullable=true)
     */
    private $fotoservicio;

     /**
     * @var string
     *
     * @ORM\Column(name="tiposervicio", type="string", length=100, nullable=false)
     */
    private $tiposervicio;

    /**
     * @var float
     *
     * @ORM\Column(name="precioservicio", type="float", nullable=false)
     */
    private $precioservicio;

     /**
     * @var integer
     *
     * @ORM\Column(name="idproducto", type="integer", nullable=false)
     */
    private $idproducto;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var \PaqueteTuristico
     *
     * @ORM\ManyToOne(targetEntity="PaqueteTuristico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paquete_turistico_idpaquete_turistico", referencedColumnName="idpaquete_turistico")
     * })
     */
    private $paqueteTuristicopaqueteTuristico;

    /**
     * @var \ServicioAlojamiento
     *
     * @ORM\ManyToOne(targetEntity="Sitpac\ExtranetBundle\Entity\ServicioAlojamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="servicio_habitacion_idservicio_habitacion", referencedColumnName="idservicio_alojamiento")
     * })
     */
    private $servicioAlojamientoservicioAlojamiento;



    /**
     * Get idservicioPaqAlo
     *
     * @return integer 
     */
    public function getIdservicioPaqAlo()
    {
        return $this->idservicioPaqAlo;
    }

    /**
     * Set fotoservicio
     *
     * @param string $fotoservicio
     * @return ServicioPaqAlo
     */
    public function setFotoServicio($fotoservicio)
    {
        $this->fotoservicio = $fotoservicio;
    
        return $this;
    }

    /**
     * Get fotoservicio
     *
     * @return string 
     */
    public function getFotoServicio()
    {
        return $this->fotoservicio;
    }

    /**
     * Set tiposervicio
     *
     * @param string $tiposervicio
     * @return ServicioPaqAlo
     */
    public function setTipoServicio($tiposervicio)
    {
        $this->tiposervicio = $tiposervicio;
    
        return $this;
    }

    /**
     * Get tiposervicio
     *
     * @return string 
     */
    public function getTipoServicio()
    {
        return $this->tiposervicio;
    }

     /**
     * Set precioservicio
     *
     * @param float $precioservicio
     * @return SrviioPaqAlo
     */
    public function setPrecioServicio($precioservicio)
    {
        $this->precioservicio = $precioservicio;
    
        return $this;
    }

    /**
     * Get precioservicio
     *
     * @return float 
     */
    public function getPrecioServicio()
    {
        return $this->precioservicio;
    }

    /**
     * Set idproducto
     *
     * @param integer $idproducto
     * @return ServicioPaqAlo
     */
    public function setIdProducto($idproducto)
    {
        $this->idproducto = $idproducto;
    
        return $this;
    }

    /**
     * Get idproducto
     *
     * @return integer 
     */
    public function getIdProducto()
    {
        return $this->idproducto;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     * @return ServicioPaqAlo
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
     * @return ServicioPaqAlo
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
     * @return ServicioPaqAlo
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
     * @return ServicioPaqAlo
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Producto
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    
        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set paqueteTuristicopaqueteTuristico
     *
     * @param \Sitpac\FrontendBundle\Entity\PaqueteTuristico $paqueteTuristicopaqueteTuristico
     * @return ServicioPaqAlo
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
     * Set servicioAlojamientoservicioAlojamiento
     *
     * @param \Sitpac\ExtranetBundle\Entity\ServicioAlojamiento $servicioAlojamientoservicioAlojamiento
     * @return ServicioPaqAlo
     */
    public function setServicioAlojamientoservicioAlojamiento(\Sitpac\ExtranetBundle\Entity\ServicioAlojamiento $servicioAlojamientoservicioAlojamiento = null)
    {
        $this->servicioAlojamientoservicioAlojamiento = $servicioAlojamientoservicioAlojamiento;
    
        return $this;
    }

    /**
     * Get servicioAlojamientoservicioAlojamiento
     *
     * @return \Sitpac\ExtranetBundle\Entity\ServicioAlojamiento
     */
    public function getServicioAlojamientoservicioAlojamiento()
    {
        return $this->servicioAlojamientoservicioAlojamiento;
    }

    public function __construct()
    {
        $this->fechaCreacion = new \DateTime();
        $this->vendido = 0;
    }
}