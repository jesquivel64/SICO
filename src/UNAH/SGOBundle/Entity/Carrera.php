<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrera
 *
 * @ORM\Entity
 */
class Carrera
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
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $color;
    
    /**
     * @ORM\ManyToOne(targetEntity="Facultad", inversedBy="carreras")
     */
    protected $facultad;
    
    /**
     * @ORM\OneToMany(targetEntity="Documento", mappedBy="carrera")
     */
    protected $documentos;
    
    /**
     * @ORM\ManyToMany(targetEntity="Centro", inversedBy="carreras")
     */
    protected $centros;
    
    public function __toString()
    {
        return $this->nombre;
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
     * @return Carrera
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
     * Set color
     *
     * @param string $color
     * @return Carrera
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
     * Constructor
     */
    public function __construct()
    {
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->centros = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set facultad
     *
     * @param \UNAH\SGOBundle\Entity\Facultad $facultad
     * @return Carrera
     */
    public function setFacultad(\UNAH\SGOBundle\Entity\Facultad $facultad = null)
    {
        $this->facultad = $facultad;

        return $this;
    }

    /**
     * Get facultad
     *
     * @return \UNAH\SGOBundle\Entity\Facultad 
     */
    public function getFacultad()
    {
        return $this->facultad;
    }

    /**
     * Add documentos
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentos
     * @return Carrera
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

    /**
     * Add centros
     *
     * @param \UNAH\SGOBundle\Entity\Centro $centros
     * @return Carrera
     */
    public function addCentro(\UNAH\SGOBundle\Entity\Centro $centros)
    {
        $this->centros[] = $centros;

        return $this;
    }

    /**
     * Remove centros
     *
     * @param \UNAH\SGOBundle\Entity\Centro $centros
     */
    public function removeCentro(\UNAH\SGOBundle\Entity\Centro $centros)
    {
        $this->centros->removeElement($centros);
    }

    /**
     * Get centros
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCentros()
    {
        return $this->centros;
    }
}
