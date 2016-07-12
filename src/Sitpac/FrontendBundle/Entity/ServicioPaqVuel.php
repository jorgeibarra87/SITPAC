<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ServicioPaqVuel
 *
 * @ORM\Table(name="servicio_paq_vuel")
 * @ORM\Entity
 */
class ServicioPaqVuel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idservicio_paq_vuel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idservicioPaqVuel;

     /**
     * @var string
     *
     * @ORM\Column(name="fotoservicio", type="string", length=255, nullable=true)
     */
    private $fotoservicio;

     /**
     * @var string
     *
     * @ORM\Column(name="compania", type="string", length=255, nullable=false)
     */
    private $compania;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vuelo", type="datetime", nullable=false)
     */
    private $fechaVuelo;

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
     * @var \ServicioVuelo
     *
     * @ORM\ManyToOne(targetEntity="Sitpac\ExtranetBundle\Entity\ServicioVuelo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="servicio_vuelo_idservicio_vuelo", referencedColumnName="idservicio_vuelo")
     * })
     */
    private $servicioVueloservicioVuelo;



    /**
     * Get idservicioPaqVuel
     *
     * @return integer 
     */
    public function getIdservicioPaqVuel()
    {
        return $this->idservicioPaqVuel;
    }

    /**
     * Set fotoservicio
     *
     * @param string $fotoservicio
     * @return ServicioPaqVuel
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
     * Set compania
     *
     * @param string $compania
     * @return ServicioPaqVuel
     */
    public function setCompania($compania)
    {
        $this->compania = $compania;
    
        return $this;
    }

    /**
     * Get compania
     *
     * @return string 
     */
    public function getCompania()
    {
        return $this->compania;
    }

     /**
     * Set precioservicio
     *
     * @param float $precioservicio
     * @return SrviioPaqAlim
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
     * @return ServicioPaqVuel
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
     * Set fechaVuelo
     *
     * @param \DateTime $fechaVuelo
     * @return ServicioPaqVuel
     */
    public function setFechaVuelo($fechaVuelo)
    {
        $this->fechaVuelo = $fechaVuelo;
    
        return $this;
    }

    /**
     * Get fechaVuelo
     *
     * @return \DateTime 
     */
    public function getFechaVuelo()
    {
        return $this->fechaVuelo;
    }

    /**
     * Set descuento
     *
     * @param string $descuento
     * @return ServicioPaqVuel
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
     * @return ServicioPaqVuel
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
     * Set servicioVueloservicioVuelo
     *
     * @param \Sitpac\ExtranetBundle\Entity\ServicioVuelo $servicioVueloservicioVuelo
     * @return ServicioPaqVuel
     */
    public function setServicioVueloservicioVuelo(\Sitpac\ExtranetBundle\Entity\ServicioVuelo $servicioVueloservicioVuelo = null)
    {
        $this->servicioVueloservicioVuelo = $servicioVueloservicioVuelo;
    
        return $this;
    }

    /**
     * Get servicioVueloservicioVuelo
     *
     * @return \Sitpac\ExtranetBundle\Entity\ServicioVuelo 
     */
    public function getServicioVueloservicioVuelo()
    {
        return $this->servicioVueloservicioVuelo;
    }

    public function __construct()
    {
        $this->fechaCreacion = new \DateTime();
        $this->vendido = 0;
    }
}