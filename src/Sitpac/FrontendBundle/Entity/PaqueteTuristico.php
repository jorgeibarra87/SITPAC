<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaqueteTuristico
 *
 * @ORM\Table(name="paquete_turistico")
 * @ORM\Entity(repositoryClass="Sitpac\FrontendBundle\Entity\PaqueteTuristicoRepository")
 */
class PaqueteTuristico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaquete_turistico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpaqueteTuristico;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var float
     *
     * @ORM\Column(name="preciototal", type="float", nullable=false)
     */
    private $preciototal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="creadocliente", type="boolean", nullable=false)
     */
    private $creadocliente;

    /**
     * @var integer
     *
     * @ORM\Column(name="creador", type="integer", nullable=false)
     */
    private $creador;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="detalles", type="text", nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100, nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="plazas", type="integer", nullable=false)
     */
    private $plazas;

    /**
     * @var integer
     *
     * @ORM\Column(name="reservas", type="integer", nullable=false)
     */
    private $reservas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cierre", type="datetime", nullable=false)
     */
    private $fechaCierre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_expiracion", type="datetime", nullable=false)
     */
    private $fechaExpiracion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var \Municipio
     *
     * @ORM\ManyToOne(targetEntity="Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="municipio_idmunicipio", referencedColumnName="idmunicipio")
     * })
     */
    private $municipiomunicipio;



    /**
     * Get idpaqueteTuristico
     *
     * @return integer 
     */
    public function getIdpaqueteTuristico()
    {
        return $this->idpaqueteTuristico;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return PaqueteTuristico
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
     * Set foto
     *
     * @param string $foto
     * @return PaqueteTuristico
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    
        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set preciototal
     *
     * @param float $preciototal
     * @return PaqueteTuristio
     */
    public function setPrecioTotal($preciototal)
    {
        $this->preciototal = $preciototal;
    
        return $this;
    }

    /**
     * Get preciototal
     *
     * @return float 
     */
    public function getPrecioTotal()
    {
        return $this->preciototal;
    }

    /**
     * Set creadocliente
     *
     * @param boolean $creadocliente
     * @return PaqueteTuristico
     */
    public function setCreadoCliente($creadocliente)
    {
        $this->creadocliente = $creadocliente;
    
        return $this;
    }

    /**
     * Get creadocliente
     *
     * @return boolean 
     */
    public function getCreadoCliente()
    {
        return $this->creadocliente;
    }

    /**
     * Set creador
     *
     * @param integer $creador
     * @return PaqueteTuristico
     */
    public function setCreador($creador)
    {
        $this->creador = $creador;
    
        return $this;
    }

    /**
     * Get creador
     *
     * @return integer 
     */
    public function getCreador()
    {
        return $this->creador;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return PaqueteTuristico
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
     * Set detalles
     *
     * @param string $detalles
     * @return PaqueteTuristico
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
     * @return PaqueteTuristico
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
     * @return PaqueteTuristico
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
     * Set estado
     *
     * @param string $estado
     * @return PaqueteTuristico
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
     * Set plazas
     *
     * @param integer $plazas
     * @return PaqueteTuristico
     */
    public function setPlazas($plazas)
    {
        $this->plazas = $plazas;
    
        return $this;
    }

    /**
     * Get plazas
     *
     * @return integer 
     */
    public function getPlazas()
    {
        return $this->plazas;
    }

    /**
     * Set reservas
     *
     * @param integer $reservas
     * @return PaqueteTuristico
     */
    public function setReservas($reservas)
    {
        $this->reservas = $reservas;
    
        return $this;
    }

    /**
     * Get reservas
     *
     * @return integer 
     */
    public function getReservas()
    {
        return $this->reservas;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return PaqueteTuristico
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
     * Set fechaCierre
     *
     * @param \DateTime $fechaCierre
     * @return PaqueteTuristico
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
     * Set fechaExpiracion
     *
     * @param \DateTime $fechaExpiracion
     * @return PaqueteTuristico
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
     * Set observaciones
     *
     * @param string $observaciones
     * @return PaqueteTuristico
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    
        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set municipiomunicipio
     *
     * @param \Sitpac\FrontendBundle\Entity\Municipio $municipiomunicipio
     * @return PaqueteTuristico
     */
    public function setMunicipiomunicipio(\Sitpac\FrontendBundle\Entity\Municipio $municipiomunicipio = null)
    {
        $this->municipiomunicipio = $municipiomunicipio;
    
        return $this;
    }

    /**
     * Get municipiomunicipio
     *
     * @return \Sitpac\FrontendBundle\Entity\Municipio 
     */
    public function getMunicipiomunicipio()
    {
        return $this->municipiomunicipio;
    }



    public function __construct()
    {
        $this->fechaCreacion = new \DateTime();
        $date = date("Y-m-d");
        $expira = strtotime ( '+10 day' , strtotime ( $date) ) ;
        $expiracion = date ( 'Y-m-d' , $expira );
        $expiracion = new \DateTime($expiracion);
        $this->fechaExpiracion = $expiracion;
        if($this->creadocliente == 1){
           $this->estado = "Creando"; 
        }
        if($this->creadocliente == 0){
           $this->estado = "Solicitud Registro"; 
        }
        $this->preciototal = 0;
        $this->plazas = 0;
        $this->reservas = 0;
    }

    public function subirFoto()
    {
        if (null === $this->foto) {
            return;
        }

        $directorioDestino = __DIR__.'/../../../../web/uploads/images/paquetes';
        $nombreArchivoFoto = uniqid('sitpac-').'-foto1.jpg';
        $this->foto->move($directorioDestino, $nombreArchivoFoto);
        $this->setFoto($nombreArchivoFoto);
    }

}