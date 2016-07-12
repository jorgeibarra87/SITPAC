<?php

namespace Sitpac\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pqr
 *
 * @ORM\Table(name="pqr")
 * @ORM\Entity(repositoryClass="Sitpac\FrontendBundle\Entity\PqrRepository")
 */
class Pqr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpqr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpqr;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=100, nullable=false)
     */
    private $tipo;

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
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_idcliente", referencedColumnName="idcliente")
     * })
     */
    private $clientecliente;

    

    /**
     * Get idpqr
     *
     * @return integer 
     */
    public function getIdpqr()
    {
        return $this->idpqr;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Pqr
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Pqr
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
     * @return Pqr
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
     * @return Pqr
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
     * @return Pqr
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
     * Set clientecliente
     *
     * @param \Sitpac\FrontendBundle\Entity\Cliente $clientecliente
     * @return Pqr
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


    public function __construct()
    {
        $this->fecha = new \DateTime();
        $this->estado = "PQR solicitada";
    }

}