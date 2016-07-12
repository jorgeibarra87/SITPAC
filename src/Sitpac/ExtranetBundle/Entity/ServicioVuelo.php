<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ServicioVuelo
 *
 * @ORM\Table(name="servicio_vuelo")
 * @ORM\Entity(repositoryClass="Sitpac\ExtranetBundle\Entity\ServicioVueloRepository")
 */
class ServicioVuelo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idservicio_vuelo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idservicioVuelo;

    /**
     * @var string
     *
     * @ORM\Column(name="compania", type="string", length=255, nullable=false)
     */
    private $compania;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255, nullable=false)
     */
    private $origen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_salida", type="time", nullable=false)
     */
    private $horaSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=255, nullable=false)
     */
    private $destino;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=100, nullable=false)
     */
    private $categoria;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", nullable=false)
     * @Assert\Type(type = "numeric", message = "Introduce un número válido para el precio.")
     * @Assert\Range(min = 0)
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="detalles", type="text", nullable=true)
     */
    private $detalles;

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
     * Get idservicioVuelo
     *
     * @return integer 
     */
    public function getIdservicioVuelo()
    {
        return $this->idservicioVuelo;
    }

    /**
     * Set compania
     *
     * @param string $compania
     * @return ServicioVuelo
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
     * Set foto
     *
     * @param string $foto
     * @return ServicioVuelo
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return ServicioVuelo
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
     * Set origen
     *
     * @param string $origen
     * @return ServicioVuelo
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
     * Set horaSalida
     *
     * @param \DateTime $horaSalida
     * @return ServicioVuelo
     */
    public function setHoraSalida($horaSalida)
    {
        $this->horaSalida = $horaSalida;
    
        return $this;
    }

    /**
     * Get horaSalida
     *
     * @return \DateTime 
     */
    public function getHoraSalida()
    {
        return $this->horaSalida;
    }

    /**
     * Set destino
     *
     * @param string $destino
     * @return ServicioVuelo
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;
    
        return $this;
    }

    /**
     * Get destino
     *
     * @return string 
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     * @return ServicioVuelo
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return ServicioVuelo
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
     * Set detalles
     *
     * @param string $detalles
     * @return ServicioVuelo
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return ServicioVuelo
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
     * @return ServicioVuelo
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
     * @return ServicioVuelo
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

        $directorioDestino = __DIR__.'/../../../../web/uploads/images/vuelo';
        $nombreArchivoFoto = uniqid('sitpac-').'-foto1.jpg';
        $this->foto->move($directorioDestino, $nombreArchivoFoto);
        $this->setFoto($nombreArchivoFoto);
    }
}