<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comentario
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Comentario
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
     * @ORM\ManyToOne(targetEntity="Documento", inversedBy="comentarios")
     * @ORM\JoinColumn(name="documento_id", referencedColumnName="id")
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
     * @ORM\Column(name="usuario", type="string", length=255, nullable=true)
     */
    private $usuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finalizado", type="datetimetz", nullable=true)
     */
    private $finalizado;
    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo", type="integer", nullable=true)
     */
    private $tiempo;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="curso", type="boolean", nullable=true)
     */
    private $curso;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="editable", type="boolean", nullable=true)
     */
    protected $editable = TRUE;
    
    public function __construct()
    {
        $this->fecha = new \DateTime();
    }
    
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
     * @param \UNAH\SGOBundle\Entity\Documento $documento
     * @return Comentario
     */
    public function setDocumento(\UNAH\SGOBundle\Entity\Documento $documento = null)
    {
        $this->documento = $documento;
        return $this;
    }

    /**
     * Get emisor
     *
     * @return \UNAH\SGOBundle\Entity\Documento 
     */
    public function getDocumento()
    {
        return $this->documento;
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
     * Set usuario
     *
     * @param string $usuario
     * @return Comentario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set finalizado
     *
     * @param \DateTime $finalizado
     * @return Comentario
     */
    public function setFinalizado($finalizado)
    {
        $this->finalizado = $finalizado;
        $this->tiempo = ($this->finalizado->getTimestamp() - $this->fecha->getTimestamp()) / 3600;
        return $this;
    }

    /**
     * Get finalizado
     *
     * @return \DateTime 
     */
    public function getFinalizado()
    {
        return $this->finalizado;
    }

    /**
     * Set tiempo
     *
     * @param integer $tiempo
     * @return Comentario
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get tiempo
     *
     * @return integer 
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set editable
     *
     * @param boolean $editable
     * @return Comentario
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;

        return $this;
    }

    /**
     * Get editable
     *
     * @return boolean 
     */
    public function getEditable()
    {
        return $this->editable;
    }

    /**
     * Set curso
     *
     * @param boolean $curso
     * @return Comentario
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return boolean 
     */
    public function getCurso()
    {
        return $this->curso;
    }
}
