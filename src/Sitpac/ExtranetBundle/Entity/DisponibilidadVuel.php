<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DisponibilidadVuel
 *
 * @ORM\Table(name="disponibilidad_vuel")
 * @ORM\Entity
 */
class DisponibilidadVuel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_disp_vuel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDispVuel;

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
     * @var \ServicioVuelo
     *
     * @ORM\ManyToOne(targetEntity="ServicioVuelo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_serv_vuel", referencedColumnName="idservicio_vuelo")
     * })
     */
    private $idServVuel;



    /**
     * Get idDispVuel
     *
     * @return integer 
     */
    public function getIdDispVuel()
    {
        return $this->idDispVuel;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     * @return DisponibilidadVuel
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
     * @return DisponibilidadVuel
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
     * @return DisponibilidadVuel
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
     * Set idServVuel
     *
     * @param \Sitpac\ExtranetBundle\Entity\ServicioVuelo $idServVuel
     * @return DisponibilidadVuel
     */
    public function setIdServVuel(\Sitpac\ExtranetBundle\Entity\ServicioVuelo $idServVuel = null)
    {
        $this->idServVuel = $idServVuel;
    
        return $this;
    }

    /**
     * Get idServVuel
     *
     * @return \Sitpac\ExtranetBundle\Entity\ServicioVuelo 
     */
    public function getIdServVuel()
    {
        return $this->idServVuel;
    }
}