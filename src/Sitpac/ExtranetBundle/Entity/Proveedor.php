<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;



/**
* Sitpac\ExtranetBundle\Entity\Proveedor
*
* @ORM\Entity(repositoryClass="Sitpac\ExtranetBundle\Entity\ProveedorRepository")
* @DoctrineAssert\UniqueEntity("email")
*/
class Proveedor implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idproveedor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message = "Por favor, escribe tu nombre")
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message = "Por favor, escribe tu apellido")
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message = "Por favor, escribe el mombre de su empresa")
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text", nullable=false)
     * @Assert\MinLength(limit = 5, message = "La dirección debería tener 5 caracteres o más para considerarse válida|La dirección debería tener 5 caracteres o más para considerarse válida")
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=45, nullable=false)
     * @Assert\NotBlank(message = "Por favor, escribe tu telefono")
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=45, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @Assert\MinLength(limit = 5, message = "La contraseña debería tener 5 caracteres o más para considerarse válida|La contraseña debería tener 5 caracteres o más para considerarse válida")
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="datetime", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var string
     *
     * @ORM\Column(name="documentos", type="string", length=255, nullable=false)
     * @Assert\File(maxSize = "20M", mimeTypes = {"application/pdf", "application/x-pdf"})
     */
    protected $documentos;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;



    /**
     * Get idproveedor
     *
     * @return integer 
     */
    public function getIdproveedor()
    {
        return $this->idproveedor;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     * @return Proveedor
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    
        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Proveedor
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     * @return Proveedor
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Proveedor
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
     * Set telefono
     *
     * @param string $telefono
     * @return Proveedor
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Proveedor
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Proveedor
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Proveedor
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Proveedor
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Proveedor
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    
        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set documentos
     *
     * @param string $documentos
     * @return Proveedor
     */
    public function setDocumentos($documentos)
    {
        $this->documentos = $documentos;
    
        return $this;
    }

    /**
     * Get documentos
     *
     * @return string 
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Proveedor
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
     * Set observaciones
     *
     * @param string $observaciones
     * @return Proveedor
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


    function eraseCredentials()
    {

    }

    function getRoles()
    {
        return array('ROLE_PROVEEDOR');
    }

    function getUsername()
    {
        return $this->getEmail();
    }



    public function __toString()
    {
        return $this->getNombres().' '.$this->getApellidos();
    }

    public function __construct()
    {
        $this->fechaAlta = new \DateTime();
        $this->estado = "Solicitud registro";
    }


    public function subirArchivo()
    {
        if (null === $this->documentos) {
            return;
        }

        $directorioDestino = __DIR__.'/../../../../web/uploads/docs';
        $nombreArchivo = uniqid('sitpac-').'-documento1.pdf';
        $this->documentos->move($directorioDestino, $nombreArchivo);
        $this->setDocumentos($nombreArchivo);
    }
}