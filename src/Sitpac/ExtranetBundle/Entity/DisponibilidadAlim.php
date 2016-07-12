<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DisponibilidadAlim
 *
 * @ORM\Table(name="disponibilidad_alim")
 * @ORM\Entity
 */
class DisponibilidadAlim
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_disp_alim", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDispAlim;

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
     * @var \ServicioAlimentacion
     *
     * @ORM\ManyToOne(targetEntity="ServicioAlimentacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_serv_alim", referencedColumnName="idalimentacion")
     * })
     */
    private $idServAlim;



    /**
     * Get idDispAlim
     *
     * @return integer 
     */
    public function getIdDispAlim()
    {
        return $this->idDispAlim;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     * @return DisponibilidadAlim
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
     * @return DisponibilidadAlim
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
     * @return DisponibilidadAlim
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
     * Set idServAlim
     *
     * @param \Sitpac\ExtranetBundle\Entity\ServicioAlimentacion $idServAlim
     * @return DisponibilidadAlim
     */
    public function setIdServAlim(\Sitpac\ExtranetBundle\Entity\ServicioAlimentacion $idServAlim = null)
    {
        $this->idServAlim = $idServAlim;
    
        return $this;
    }

    /**
     * Get idServAlim
     *
     * @return \Sitpac\ExtranetBundle\Entity\ServicioAlimentacion 
     */
    public function getIdServAlim()
    {
        return $this->idServAlim;
    }
}