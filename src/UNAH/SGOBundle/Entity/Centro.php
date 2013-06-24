<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Centro
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Centro
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
     * @ORM\OneToMany(targetEntity="Documento", mappedBy="centro")
     */
    protected $documentos;
    
    /**
     * @ORM\ManyToMany(targetEntity="Facultad", mappedBy="centros")
     */
    protected $facultades;
    
    /**
     * @ORM\ManyToMany(targetEntity="Carrera", mappedBy="centros")
     */
    protected $carreras;
    
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
     * @return Centro
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
     * @return Centro
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
     * Add documentos
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentos
     * @return Centro
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
     * @param \UNAH\SGOBundle\Entity\Carrera $centros
     * @return Centro
     */
    public function addCentro(\UNAH\SGOBundle\Entity\Carrera $centros)
    {
        $this->centros[] = $centros;

        return $this;
    }

    /**
     * Remove centros
     *
     * @param \UNAH\SGOBundle\Entity\Carrera $centros
     */
    public function removeCentro(\UNAH\SGOBundle\Entity\Carrera $centros)
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
