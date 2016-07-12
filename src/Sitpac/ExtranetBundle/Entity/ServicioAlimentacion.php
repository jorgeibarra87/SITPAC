<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ServicioAlimentacion
 *
 * @ORM\Table(name="servicio_alimentacion")
 * @ORM\Entity(repositoryClass="Sitpac\ExtranetBundle\Entity\ServicioAlimentacionRepository")
 */
class ServicioAlimentacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idalimentacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idalimentacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=100, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="time", nullable=false)
     */
    private $hora;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text", nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="detalles", type="text", nullable=true)
     */
    private $detalles;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", nullable=false)
     * @Assert\Type(type = "numeric", message = "Introduce un número válido para el precio.")
     * @Assert\Range(min = 0)
     */
    private $precio;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion;

     /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100, nullable=false)
     */
    private $estado;

    /**
     * @var \Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="producto_idproducto", referencedColumnName="idproducto")
     * })
     */
    private $productoproducto;



    /**
     * Get idalimentacion
     *
     * @return integer 
     */
    public function getIdalimentacion()
    {
        return $this->idalimentacion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return ServicioAlimentacion
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
     * Set tipo
     *
     * @param string $tipo
     * @return ServicioAlimentacion
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
     * Set foto
     *
     * @param string $foto
     * @return ServicioAlimentacion
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
     * Set hora
     *
     * @param \DateTime $hora
     * @return ServicioAlimentacion
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    
        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime 
     */
    public function getHora()
    {
        return $this->hora;
    }

     /**
     * Set direccion
     *
     * @param string $direccion
     * @return ServicioAlimentacion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set detalles
     *
     * @param string $detalles
     * @return ServicioAlimentacion
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
     * Set precio
     *
     * @param float $precio
     * @return ServicioAlimentacion
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return ServicioAlimentacion
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
     * Set estado
     *
     * @param string $estado
     * @return ServicioAlimentacion
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
     * Set productoproducto
     *
     * @param \Sitpac\ExtranetBundle\Entity\Producto $productoproducto
     * @return ServicioAlimentacion
     */
    public function setProductoproducto(\Sitpac\ExtranetBundle\Entity\Producto $productoproducto = null)
    {
        $this->productoproducto = $productoproducto;
    
        return $this;
    }

    /**
     * Get productoproducto
     *
     * @return \Sitpac\ExtranetBundle\Entity\Producto 
     */
    public function getProductoproducto()
    {
        return $this->productoproducto;
    }

     public function __construct()
    {
        $this->fechaCreacion = new \DateTime();
        $this->estado = "Creando";
    }

    public function subirFoto()
    {
        if (null === $this->foto) {
            return;
        }

        $directorioDestino = __DIR__.'/../../../../web/uploads/images/alimentacion';
        $nombreArchivoFoto = uniqid('sitpac-').'-foto1.jpg';
        $this->foto->move($directorioDestino, $nombreArchivoFoto);
        $this->setFoto($nombreArchivoFoto);
    }
}