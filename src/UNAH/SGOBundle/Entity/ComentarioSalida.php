<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComentarioSalida
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ComentarioSalida
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
     * @ORM\ManyToOne(targetEntity="DocumentoSalida", inversedBy="comentarios")
     * @ORM\JoinColumn(name="documento_salida_id", referencedColumnName="id")
     */
    private $documento;
	
    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=255)
     */
    private $comentario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetimetz")
     */
    private $fecha;
	
	/**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255)
     */
	private $estado;
	
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
     * Set comentario
     *
     * @param string $comentario
     * @return Comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    
        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set emisor
     *
     * @param \UNAH\SGOBundle\Entity\Oficio $emisor
     * @return Comentario
     */
    public function setOficio(\UNAH\SGOBundle\Entity\Oficio $oficio = null)
    {
        $this->oficio = $oficio;
    
        return $this;
    }

    /**
     * Get emisor
     *
     * @return \UNAH\SGOBundle\Entity\Oficio 
     */
    public function getOficio()
    {
        return $this->oficio;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Comentario
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
     * Set estado
     *
     * @param string $estado
     * @return Comentario
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
     * Set documento
     *
     * @param \UNAH\SGOBundle\Entity\DocumentoSalida $documento
     * @return ComentarioSalida
     */
    public function setDocumento(\UNAH\SGOBundle\Entity\DocumentoSalida $documento = null)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return \UNAH\SGOBundle\Entity\DocumentoSalida 
     */
    public function getDocumento()
    {
        return $this->documento;
    }
}
