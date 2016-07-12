<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ServicioPaqExcu
 *
 * @ORM\Table(name="servicio_paq_excu")
 * @ORM\Entity
 */
class ServicioPaqExcu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idservicio_paq_excu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idservicioPaqExcu;

     /**
     * @var string
     *
     * @ORM\Column(name="fotoservicio", type="string", length=255, nullable=true)
     */
    private $fotoservicio;

     /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

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
     * @var \ServicioExcursion
     *
     * @ORM\ManyToOne(targetEntity="Sitpac\ExtranetBundle\Entity\ServicioExcursion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="servicio_excursion_idexcursiones", referencedColumnName="idexcursiones")
     * })
     */
    private $servicioExcursionexcursiones;



    /**
     * Get idservicioPaqExcu
     *
     * @return integer 
     */
    public function getIdservicioPaqExcu()
    {
        return $this->idservicioPaqExcu;
    }

    /**
     * Set fotoservicio
     *
     * @param string $fotoservicio
     * @return ServicioPaqExcu
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
     * Set nombre
     *
     * @param string $nombre
     * @return ServicioPaqExcu
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
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
     * @return ServicioPaqExcu
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
     * @return ServicioPaqExcu
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
     * @return ServicioPaqExcu
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
     * @param string $descuento
     * @return ServicioPaqExcu
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return string 
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
     * @return ServicioPaqExcu
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
     * Set servicioExcursionexcursiones
     *
     * @param \Sitpac\ExtranetBundle\Entity\ServicioExcursion $servicioExcursionexcursiones
     * @return ServicioPaqExcu
     */
    public function setServicioExcursionexcursiones(\Sitpac\ExtranetBundle\Entity\ServicioExcursion $servicioExcursionexcursiones = null)
    {
        $this->servicioExcursionexcursiones = $servicioExcursionexcursiones;
    
        return $this;
    }

    /**
     * Get servicioExcursionexcursiones
     *
     * @return \Sitpac\ExtraetBundle\Entity\ServicioExcursion 
     */
    public function getServicioExcursionexcursiones()
    {
        return $this->servicioExcursionexcursiones;
    }

    public function __construct()
    {
        $this->fechaCreacion = new \DateTime();
        $this->vendido = 0;
    }
}