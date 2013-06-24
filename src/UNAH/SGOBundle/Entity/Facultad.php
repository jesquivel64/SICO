<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facultad
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Facultad
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
     * @ORM\OneToMany(targetEntity="Carrera", mappedBy="facultad")
     * @ORM\OrderBy({"nombre" = "ASC"})
     */
    protected $carreras;
    
    /**
     * @ORM\OneToMany(targetEntity="Documento", mappedBy="facultad")
     */
    protected $documentos;
    
    /**
     * @ORM\ManyToMany(targetEntity="Centro", inversedBy="facultades")
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
     * @return Facultad
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
     * @return Facultad
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
        $this->carreras = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->centros = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add carreras
     *
     * @param \UNAH\SGOBundle\Entity\Carrera $carreras
     * @return Facultad
     */
    public function addCarrera(\UNAH\SGOBundle\Entity\Carrera $carreras)
    {
        $this->carreras[] = $carreras;

        return $this;
    }

    /**
     * Remove carreras
     *
     * @param \UNAH\SGOBundle\Entity\Carrera $carreras
     */
    public function removeCarrera(\UNAH\SGOBundle\Entity\Carrera $carreras)
    {
        $this->carreras->removeElement($carreras);
    }

    /**
     * Get carreras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCarreras()
    {
        return $this->carreras;
    }

    /**
     * Add documentos
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentos
     * @return Facultad
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
     * @return Facultad
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
