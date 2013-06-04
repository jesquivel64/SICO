<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoDocumento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TipoDocumento
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="plural", type="string", length=255)
     */
    private $plural;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255)
     */
    private $imagen;
    
    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     */
    private $color;
    
    /**
     * @ORM\OneToMany(targetEntity="Documento", mappedBy="tipo")
     */
    private $documentos;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return TipoDocumento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add documentos
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentos
     * @return TipoDocumento
     */
    public function addDocumento(\UNAH\SGOBundle\Entity\Documento $documentos)
    {
        $this->documentos[] = $documentos;

        return $this;
    }

    /**
     * Remove documentos
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentos
     */
    public function removeDocumento(\UNAH\SGOBundle\Entity\Documento $documentos)
    {
        $this->documentos->removeElement($documentos);
    }

    /**
     * Get documentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }
    
    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return TipoDocumento
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set plural
     *
     * @param string $plural
     * @return TipoDocumento
     */
    public function setPlural($plural)
    {
        $this->plural = $plural;

        return $this;
    }

    /**
     * Get plural
     *
     * @return string 
     */
    public function getPlural()
    {
        return $this->plural;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return TipoDocumento
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }
}
