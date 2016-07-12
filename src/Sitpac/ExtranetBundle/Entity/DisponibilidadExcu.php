<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DisponibilidadExcu
 *
 * @ORM\Table(name="disponibilidad_excu")
 * @ORM\Entity
 */
class DisponibilidadExcu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_disp_excu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDispExcu;

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
     * @var \ServicioExcursion
     *
     * @ORM\ManyToOne(targetEntity="ServicioExcursion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_serv_excu", referencedColumnName="idexcursiones")
     * })
     */
    private $idServExcu;



    /**
     * Get idDispExcu
     *
     * @return integer 
     */
    public function getIdDispExcu()
    {
        return $this->idDispExcu;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     * @return DisponibilidadExcu
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
     * @return DisponibilidadExcu
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
     * @return DisponibilidadExcu
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
     * Set idServExcu
     *
     * @param \Sitpac\ExtranetBundle\Entity\ServicioExcursion $idServExcu
     * @return DisponibilidadExcu
     */
    public function setIdServExcu(\Sitpac\ExtranetBundle\Entity\ServicioExcursion $idServExcu = null)
    {
        $this->idServExcu = $idServExcu;
    
        return $this;
    }

    /**
     * Get idServExcu
     *
     * @return \Sitpac\ExtranetBundle\Entity\ServicioExcursion 
     */
    public function getIdServExcu()
    {
        return $this->idServExcu;
    }
}