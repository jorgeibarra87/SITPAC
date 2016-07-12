<?php

namespace Sitpac\ExtranetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DisponibilidadAlo
 *
 * @ORM\Table(name="disponibilidad_alo")
 * @ORM\Entity
 */
class DisponibilidadAlo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_disp_alo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDispAlo;

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
     * @var \ServicioAlojamiento
     *
     * @ORM\ManyToOne(targetEntity="ServicioAlojamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_serv_alo", referencedColumnName="idservicio_alojamiento")
     * })
     */
    private $idServAlo;



    /**
     * Get idDispAlo
     *
     * @return integer 
     */
    public function getIdDispAlo()
    {
        return $this->idDispAlo;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     * @return DisponibilidadAlo
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
     * @return DisponibilidadAlo
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
     * @return DisponibilidadAlo
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
     * Set idServAlo
     *
     * @param \Sitpac\ExtranetBundle\Entity\ServicioAlojamiento $idServAlo
     * @return DisponibilidadAlo
     */
    public function setIdServAlo(\Sitpac\ExtranetBundle\Entity\ServicioAlojamiento $idServAlo = null)
    {
        $this->idServAlo = $idServAlo;
    
        return $this;
    }

    /**
     * Get idServAlo
     *
     * @return \Sitpac\ExtranetBundle\Entity\ServicioAlojamiento 
     */
    public function getIdServAlo()
    {
        return $this->idServAlo;
    }
}