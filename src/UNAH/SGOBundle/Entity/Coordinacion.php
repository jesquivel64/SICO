<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coordinacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Coordinacion
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
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;
    
    /**
     * @ORM\OneToMany(targetEntity="TipoSolicitud", mappedBy="coordinacion")
     * @ORM\OrderBy({"nombre" = "ASC"})
     */
    protected $solicitudes;
    
    /**
     * @ORM\OneToMany(targetEntity="Documento", mappedBy="coordinacion")
     */
    protected $documentos;
    
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
     * @return Coordinacion
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
     * @return Coordinacion
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
        $this->solicitudes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add solicitudes
     *
     * @param \UNAH\SGOBundle\Entity\TipoSolicitud $solicitudes
     * @return Coordinacion
     */
    public function addSolicitude(\UNAH\SGOBundle\Entity\TipoSolicitud $solicitudes)
    {
        $this->solicitudes[] = $solicitudes;

        return $this;
    }

    /**
     * Remove solicitudes
     *
     * @param \UNAH\SGOBundle\Entity\TipoSolicitud $solicitudes
     */
    public function removeSolicitude(\UNAH\SGOBundle\Entity\TipoSolicitud $solicitudes)
    {
        $this->solicitudes->removeElement($solicitudes);
    }

    /**
     * Get solicitudes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitudes()
    {
        return $this->solicitudes;
    }

    /**
     * Add documentos
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentos
     * @return Coordinacion
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
}
