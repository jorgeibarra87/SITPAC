<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DisponibilidadVehi
 *
 * @ORM\Table(name="disponibilidad_vehi")
 * @ORM\Entity
 */
class DisponibilidadVehi
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_disp_vehi", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDispVehi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="desde", type="datetime", nullable=false)
     */
    private $desde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hasta", type="datetime", nullable=false)
     */
    private $hasta;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100, nullable=false)
     */
    private $estado;

    /**
     * @var \ServicioVehiculo
     *
     * @ORM\ManyToOne(targetEntity="ServicioVehiculo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_serv_vehi", referencedColumnName="idservicio_vehiculo")
     * })
     */
    private $idServVehi;



    /**
     * Get idDispVehi
     *
     * @return integer 
     */
    public function getIdDispVehi()
    {
        return $this->idDispVehi;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     * @return DisponibilidadVehi
     */
    public function setDesde($desde)
    {
        $this->desde = $desde;
    
        return $this;
    }

    /**
     * Get desde
     *
     * @return \DateTime 
     */
    public function getDesde()
    {
        return $this->desde;
    }

    /**
     * Set hasta
     *
     * @param \DateTime $hasta
     * @return DisponibilidadVehi
     */
    public function setHasta($hasta)
    {
        $this->hasta = $hasta;
    
        return $this;
    }

    /**
     * Get hasta
     *
     * @return \DateTime 
     */
    public function getHasta()
    {
        return $this->hasta;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return DisponibilidadVehi
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
     * Set idServVehi
     *
     * @param \Sitpac\ExtranetBundle\Entity\ServicioVehiculo $idServVehi
     * @return DisponibilidadVehi
     */
    public function setIdServVehi(\Sitpac\ExtranetBundle\Entity\ServicioVehiculo $idServVehi = null)
    {
        $this->idServVehi = $idServVehi;
    
        return $this;
    }

    /**
     * Get idServVehi
     *
     * @return \Sitpac\ExtranetBundle\Entity\ServicioVehiculo 
     */
    public function getIdServVehi()
    {
        return $this->idServVehi;
    }
}