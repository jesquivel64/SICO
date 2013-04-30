<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Oficio
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Oficio
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
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Departamento", inversedBy="oficios")
     * @ORM\JoinColumn(name="emisor_id", referencedColumnName="id")
     */
    private $emisor;

    /**
     * @var string
     *
     * @ORM\Column(name="recibio", type="string", length=255)
     */
    private $recibio;
	
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=true)
     */
    private $estado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="remitente", type="string", length=255, nullable=true)
     */
    private $remitente;
    
    /**
     * @var string
     *
     * @ORM\Column(name="destinatario", type="string", length=255, nullable=true)
     */
    private $destinatario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetimetz", nullable=true)
     */
    private $fecha_de_recibido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="emitido", type="datetimetz", nullable=true)
     */
    private $fecha_de_emision;
	
	/**
     * @ORM\OneToMany(targetEntity="Comentario", mappedBy="oficio")
     */
    protected $comentarios;
	
	/**
     * @ORM\OneToMany(targetEntity="Adjunto", mappedBy="oficio")
     */
    protected $adjuntos;


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
     * Set numero
     *
     * @param integer $numero
     * @return Oficio
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Oficio
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
     * Set emisor
     *
     * @param \stdClass $emisor
     * @return Oficio
     */
    public function setEmisor($emisor)
    {
        $this->emisor = $emisor;
    
        return $this;
    }

    /**
     * Get emisor
     *
     * @return \stdClass 
     */
    public function getEmisor()
    {
        return $this->emisor;
    }

    /**
     * Set recibio
     *
     * @param \stdClass $recibio
     * @return Oficio
     */
    public function setRecibio($recibio)
    {
        $this->recibio = $recibio;
    
        return $this;
    }

    /**
     * Get recibio
     *
     * @return \stdClass 
     */
    public function getRecibio()
    {
        return $this->recibio;
    }
	
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comentarios = new \Doctrine\Common\Collections\ArrayCollection();
		$this->adjuntos =  new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comentarios
     *
     * @param \UNAH\SGOBundle\Entity\Comentario $comentarios
     * @return Oficio
     */
    public function addComentario(\UNAH\SGOBundle\Entity\Comentario $comentarios)
    {
        $this->comentarios[] = $comentarios;
    
        return $this;
    }

    /**
     * Remove comentarios
     *
     * @param \UNAH\SGOBundle\Entity\Comentario $comentarios
     */
    public function removeComentario(\UNAH\SGOBundle\Entity\Comentario $comentarios)
    {
        $this->comentarios->removeElement($comentarios);
    }

    /**
     * Get comentarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Add adjuntos
     *
     * @param \UNAH\SGOBundle\Entity\Adjunto $adjuntos
     * @return Oficio
     */
    public function addAdjunto(\UNAH\SGOBundle\Entity\Adjunto $adjuntos)
    {
        $this->adjuntos[] = $adjuntos;
    
        return $this;
    }

    /**
     * Remove adjuntos
     *
     * @param \UNAH\SGOBundle\Entity\Adjunto $adjuntos
     */
    public function removeAdjunto(\UNAH\SGOBundle\Entity\Adjunto $adjuntos)
    {
        $this->adjuntos->removeElement($adjuntos);
    }

    /**
     * Get adjuntos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdjuntos()
    {
        return $this->adjuntos;
    }
	
	public function __toString()
	{
		return "Oficio ".$this->numero." ".$this->emisor->getNombre();
	}

    /**
     * Set fecha_de_recibido
     *
     * @param \DateTime $fechaDeRecibido
     * @return Oficio
     */
    public function setFechaDeRecibido($fechaDeRecibido)
    {
        $this->fecha_de_recibido = $fechaDeRecibido;
    
        return $this;
    }

    /**
     * Get fecha_de_recibido
     *
     * @return \DateTime 
     */
    public function getFechaDeRecibido()
    {
        return $this->fecha_de_recibido;
    }

    /**
     * Set fecha_de_emision
     *
     * @param \DateTime $fechaDeEmision
     * @return Oficio
     */
    public function setFechaDeEmision($fechaDeEmision)
    {
        $this->fecha_de_emision = $fechaDeEmision;
    
        return $this;
    }

    /**
     * Get fecha_de_emision
     *
     * @return \DateTime 
     */
    public function getFechaDeEmision()
    {
        return $this->fecha_de_emision;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Oficio
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
     * Set remitente
     *
     * @param string $remitente
     * @return Oficio
     */
    public function setRemitente($remitente)
    {
        $this->remitente = $remitente;
    
        return $this;
    }

    /**
     * Get remitente
     *
     * @return string 
     */
    public function getRemitente()
    {
        return $this->remitente;
    }

    /**
     * Set destinatario
     *
     * @param string $destinatario
     * @return Oficio
     */
    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;
    
        return $this;
    }

    /**
     * Get destinatario
     *
     * @return string 
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }
}