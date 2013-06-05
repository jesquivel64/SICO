<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Accion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoAccion", inversedBy="acciones")
     * @ORM\JoinColumn(name="tipo_accion_id", referencedColumnName="id")
     */
    protected $tipo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Documento", inversedBy="acciones")
     * @ORM\JoinColumn(name="documento_id", referencedColumnName="id")
     */
    protected $documento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetimetz")
     */
    private $fecha;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="completada", type="boolean", nullable=true)
     */
    protected $completada = FALSE;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Accion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Accion
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
     * Set tipo
     *
     * @param \UNAH\SGOBundle\Entity\TipoAccion $tipo
     * @return Accion
     */
    public function setTipo(\UNAH\SGOBundle\Entity\TipoAccion $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \UNAH\SGOBundle\Entity\TipoAccion 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set documento
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documento
     * @return Accion
     */
    public function setDocumento(\UNAH\SGOBundle\Entity\Documento $documento = null)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return \UNAH\SGOBundle\Entity\Documento 
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set completada
     *
     * @param boolean $completada
     * @return Accion
     */
    public function setCompletada($completada)
    {
        $this->completada = $completada;

        return $this;
    }

    /**
     * Get completada
     *
     * @return boolean 
     */
    public function getCompletada()
    {
        return $this->completada;
    }
}
