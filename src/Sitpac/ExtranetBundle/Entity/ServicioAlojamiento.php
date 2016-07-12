<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ServicioAlojamiento
 *
 * @ORM\Table(name="servicio_alojamiento")
 * @ORM\Entity(repositoryClass="Sitpac\ExtranetBundle\Entity\ServicioAlojamientoRepository")
 */
class ServicioAlojamiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idservicio_alojamiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idservicioAlojamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_alojamiento", type="string", length=10, nullable=false)
     */
    private $codigoAlojamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_alojamiento", type="string", length=100, nullable=false)
     */
    private $tipoAlojamiento;

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
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

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
     * @ORM\ManyToOne(targetEntity="Sitpac\ExtranetBundle\Entity\Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="producto_idproducto", referencedColumnName="idproducto")
     * })
     */
    private $productoproducto;



    /**
     * Get idservicioAlojamiento
     *
     * @return integer 
     */
    public function getIdservicioAlojamiento()
    {
        return $this->idservicioAlojamiento;
    }

    /**
     * Set codigoAlojamiento
     *
     * @param string $codigoAlojamiento
     * @return ServicioAlojamiento
     */
    public function setCodigoAlojamiento($codigoAlojamiento)
    {
        $this->codigoAlojamiento = $codigoAlojamiento;
    
        return $this;
    }

    /**
     * Get codigoAlojamiento
     *
     * @return string 
     */
    public function getCodigoAlojamiento()
    {
        return $this->codigoAlojamiento;
    }

    /**
     * Set tipoAlojamiento
     *
     * @param string $tipoAlojamiento
     * @return ServicioAlojamiento
     */
    public function setTipoAlojamiento($tipoAlojamiento)
    {
        $this->tipoAlojamiento = $tipoAlojamiento;
    
        return $this;
    }

    /**
     * Get tipoAlojamiento
     *
     * @return string 
     */
    public function getTipoAlojamiento()
    {
        return $this->tipoAlojamiento;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return ServicioAlojamiento
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
     * Set foto
     *
     * @param string $foto
     * @return ServicioAlojamiento
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
     * Set detalles
     *
     * @param string $detalles
     * @return ServicioAlojamiento
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
     * @return ServicioAlojamiento
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
     * @return ServicioAlojamiento
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
     * @return ServicioAlojamiento
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

        $directorioDestino = __DIR__.'/../../../../web/uploads/images/alojamiento';
        $nombreArchivoFoto = uniqid('sitpac-').'-foto1.jpg';
        $this->foto->move($directorioDestino, $nombreArchivoFoto);
        $this->setFoto($nombreArchivoFoto);
    }
}