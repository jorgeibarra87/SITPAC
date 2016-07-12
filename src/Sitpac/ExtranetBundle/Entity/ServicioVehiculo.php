<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ServicioVehiculo
 *
 * @ORM\Table(name="servicio_vehiculo")
 * @ORM\Entity(repositoryClass="Sitpac\ExtranetBundle\Entity\ServicioVehiculoRepository")
 */
class ServicioVehiculo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idservicio_vehiculo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idservicioVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=100, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="chofer", type="string", length=255, nullable=false)
     */
    private $chofer;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=20, nullable=false)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="placa", type="string", length=15, nullable=false)
     */
    private $placa;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255, nullable=false)
     */
    private $origen;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=255, nullable=false)
     */
    private $destino;

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
     * Get idservicioVehiculo
     *
     * @return integer 
     */
    public function getIdservicioVehiculo()
    {
        return $this->idservicioVehiculo;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return ServicioVehiculo
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
     * Set chofer
     *
     * @param string $chofer
     * @return ServicioVehiculo
     */
    public function setChofer($chofer)
    {
        $this->chofer = $chofer;
    
        return $this;
    }

    /**
     * Get chofer
     *
     * @return string 
     */
    public function getChofer()
    {
        return $this->chofer;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return ServicioVehiculo
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
     * Set modelo
     *
     * @param string $modelo
     * @return ServicioVehiculo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    
        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set placa
     *
     * @param string $placa
     * @return ServicioVehiculo
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    
        return $this;
    }

    /**
     * Get placa
     *
     * @return string 
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * Set origen
     *
     * @param string $origen
     * @return ServicioVehiculo
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
     * Set destino
     *
     * @param string $destino
     * @return ServicioVehiculo
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
     * Set precio
     *
     * @param float $precio
     * @return ServicioVehiculo
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
     * @return ServicioVehiculo
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
     * @return ServicioExcurcion
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
     * @return ServicioVehiculo
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
     * @return ServicioVehiculo
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

        $directorioDestino = __DIR__.'/../../../../web/uploads/images/vehiculo';
        $nombreArchivoFoto = uniqid('sitpac-').'-foto1.jpg';
        $this->foto->move($directorioDestino, $nombreArchivoFoto);
        $this->setFoto($nombreArchivoFoto);
    }
}