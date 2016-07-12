<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Reserva
 *
 * @ORM\Table(name="reserva")
 * @ORM\Entity(repositoryClass="Sitpac\FrontendBundle\Entity\ReservaRepository")
 */
class Reserva
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreserva", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreserva;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_cliente", type="string", length=100, nullable=false)
     */
    private $nombreCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=100, nullable=false)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="adultos", type="integer", nullable=false)
     * @Assert\Type(type = "numeric", message = "El menor número de adultos a ingresar es 1")
     * @Assert\Range(min = 1)
     */
    private $adultos;

    /**
     * @var integer
     *
     * @ORM\Column(name="ninos", type="integer", nullable=false)
     * @Assert\Type(type = "numeric", message = "El menor número de niños a ingresar es 0")
     * @Assert\Range(min = 0)
     */
    private $ninos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_paquete", type="string", length=100, nullable=false)
     */
    private $nombrePaquete;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="datetime", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cierre", type="datetime", nullable=false)
     */
    private $fechaCierre;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion", type="integer", nullable=false)
     */
    private $duracion;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_paquete", type="float", nullable=false)
     */
    private $precioPaquete;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_total", type="float", nullable=false)
     */
    private $precioTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_reservado", type="datetime", nullable=false)
     */
    private $fechaReservado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_expiracion", type="datetime", nullable=false)
     */
    private $fechaExpiracion;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_idcliente", referencedColumnName="idcliente")
     * })
     */
    private $clientecliente;

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
     * Get idreserva
     *
     * @return integer 
     */
    public function getIdreserva()
    {
        return $this->idreserva;
    }

    /**
     * Set nombreCliente
     *
     * @param string $nombreCliente
     * @return Reserva
     */
    public function setNombreCliente($nombreCliente)
    {
        $this->nombreCliente = $nombreCliente;
    
        return $this;
    }

    /**
     * Get nombreCliente
     *
     * @return string 
     */
    public function getNombreCliente()
    {
        return $this->nombreCliente;
    }

    /**
     * Set origen
     *
     * @param string $origen
     * @return Reserva
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;
    
        return $this;
    }

    /**
     * Get origen
     *
     * @return string 
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set adultos
     *
     * @param integer $adultos
     * @return Reserva
     */
    public function setAdultos($adultos)
    {
        $this->adultos = $adultos;
    
        return $this;
    }

    /**
     * Get adultos
     *
     * @return integer 
     */
    public function getAdultos()
    {
        return $this->adultos;
    }

    /**
     * Set ninos
     *
     * @param integer $ninos
     * @return Reserva
     */
    public function setNinos($ninos)
    {
        $this->ninos = $ninos;
    
        return $this;
    }

    /**
     * Get ninos
     *
     * @return integer 
     */
    public function getNinos()
    {
        return $this->ninos;
    }

    /**
     * Set nombrePaquete
     *
     * @param string $nombrePaquete
     * @return Reserva
     */
    public function setNombrePaquete($nombrePaquete)
    {
        $this->nombrePaquete = $nombrePaquete;
    
        return $this;
    }

    /**
     * Get nombrePaquete
     *
     * @return string 
     */
    public function getNombrePaquete()
    {
        return $this->nombrePaquete;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Reserva
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Reserva
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
     * Set fechaCierre
     *
     * @param \DateTime $fechaCierre
     * @return Reserva
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fechaCierre = $fechaCierre;
    
        return $this;
    }

    /**
     * Get fechaCierre
     *
     * @return \DateTime 
     */
    public function getFechaCierre()
    {
        return $this->fechaCierre;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     * @return Reserva
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
     * Set precioPaquete
     *
     * @param float $precioPaquete
     * @return Reserva
     */
    public function setPrecioPaquete($precioPaquete)
    {
        $this->precioPaquete = $precioPaquete;
    
        return $this;
    }

    /**
     * Get precioPaquete
     *
     * @return float 
     */
    public function getPrecioPaquete()
    {
        return $this->precioPaquete;
    }

    /**
     * Set precioTotal
     *
     * @param float $precioTotal
     * @return Reserva
     */
    public function setPrecioTotal($precioTotal)
    {
        $this->precioTotal = $precioTotal;
    
        return $this;
    }

    /**
     * Get precioTotal
     *
     * @return float 
     */
    public function getPrecioTotal()
    {
        return $this->precioTotal;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Reserva
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
     * Set fechaReservado
     *
     * @param \DateTime $fechaReservado
     * @return Reserva
     */
    public function setFechaReservado($fechaReservado)
    {
        $this->fechaReservado = $fechaReservado;
    
        return $this;
    }

    /**
     * Get fechaReservado
     *
     * @return \DateTime 
     */
    public function getFechaReservado()
    {
        return $this->fechaReservado;
    }

    /**
     * Set fechaExpiracion
     *
     * @param \DateTime $fechaExpiracion
     * @return Reserva
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;
    
        return $this;
    }

    /**
     * Get fechaExpiracion
     *
     * @return \DateTime 
     */
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }

    /**
     * Set clientecliente
     *
     * @param \Sitpac\FrontendBundle\Entity\Cliente $clientecliente
     * @return Reserva
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

    /**
     * Set paqueteTuristicopaqueteTuristico
     *
     * @param \Sitpac\FrontendBundle\Entity\PaqueteTuristico $paqueteTuristicopaqueteTuristico
     * @return Reserva
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

     public function __construct()
    {
        $this->fechaReservado = new \DateTime();
        $date = date("Y-m-d");
        $expira = strtotime ( '+10 day' , strtotime ( $date) ) ;
        $expiracion = date ( 'Y-m-d' , $expira );
        $expiracion = new \DateTime($expiracion);
        $this->fechaExpiracion = $expiracion;
        $this->estado = "En Reserva";

    }
}