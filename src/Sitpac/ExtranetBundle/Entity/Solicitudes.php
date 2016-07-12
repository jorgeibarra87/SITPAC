<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solicitudes
 *
 * @ORM\Table(name="solicitudes")
 * @ORM\Entity
 */
class Solicitudes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_solicitud", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="solicitud", type="string", length=100, nullable=false)
     */
    private $solicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="respuesta", type="text", nullable=true)
     */
    private $respuesta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100, nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="solicitante", type="integer", nullable=false)
     */
    private $solicitante;

    /**
     * @var string
     *
     * @ORM\Column(name="nomsolicitante", type="string", length=255, nullable=false)
     */
    private $nomsolicitante;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_elemento", type="integer", nullable=false)
     */
    private $idElemento;

    /**
     * @var string
     *
     * @ORM\Column(name="nomelemento", type="string", length=255, nullable=false)
     */
    private $nomelemento;


    /**
     * Get idSolicitud
     *
     * @return integer 
     */
    public function getIdSolicitud()
    {
        return $this->idSolicitud;
    }

    /**
     * Set solicitud
     *
     * @param string $solicitud
     * @return Solicitudes
     */
    public function setSolicitud($solicitud)
    {
        $this->solicitud = $solicitud;
    
        return $this;
    }

    /**
     * Get solicitud
     *
     * @return string 
     */
    public function getSolicitud()
    {
        return $this->solicitud;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Solicitudes
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
     * Set respuesta
     *
     * @param string $respuesta
     * @return Solicitudes
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    
        return $this;
    }

    /**
     * Get respuesta
     *
     * @return string 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Solicitudes
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Solicitudes
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
     * Set solicitante
     *
     * @param integer $solicitante
     * @return Solicitudes
     */
    public function setSolicitante($solicitante)
    {
        $this->solicitante = $solicitante;
    
        return $this;
    }

    /**
     * Get solicitante
     *
     * @return integer 
     */
    public function getSolicitante()
    {
        return $this->solicitante;
    }

    /**
     * Set nomsolicitante
     *
     * @param string $nomsolicitante
     * @return Solicitudes
     */
    public function setNomsolicitante($nomsolicitante)
    {
        $this->nomsolicitante = $nomsolicitante;
    
        return $this;
    }

    /**
     * Get nomsolicitante
     *
     * @return string 
     */
    public function getNomsolicitante()
    {
        return $this->nomsolicitante;
    }

    /**
     * Set idElemento
     *
     * @param integer $idElemento
     * @return Solicitudes
     */
    public function setIdElemento($idElemento)
    {
        $this->idElemento = $idElemento;
    
        return $this;
    }

    /**
     * Get idElemento
     *
     * @return integer 
     */
    public function getIdElemento()
    {
        return $this->idElemento;
    }

    /**
     * Set nomelemento
     *
     * @param string $nomelemento
     * @return Solicitudes
     */
    public function setNomelemento($nomelemento)
    {
        $this->nomelemento = $nomelemento;
    
        return $this;
    }

    /**
     * Get nomelemento
     *
     * @return string 
     */
    public function getNomelemento()
    {
        return $this->nomelemento;
    }

    public function __construct()
    {
        $this->fecha = new \DateTime();
        $this->estado = "En Solicitud"; 
    }

}