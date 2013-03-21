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
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer")
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
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetimetz")
     */
    private $fecha;
	
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Oficio
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
}