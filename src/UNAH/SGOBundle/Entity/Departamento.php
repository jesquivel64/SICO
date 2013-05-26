<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Departamento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Departamento
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
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     */
    private $color;
    
	
	/**
     * @ORM\OneToMany(targetEntity="Documento", mappedBy="emisor")
     */
    protected $documentos;
    
    /**
     * @ORM\ManyToMany(targetEntity="Documento", inversedBy="receptores")
     */
    private $documentosEnviados;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documentosRecibidos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documentosEnviados = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Departamento
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
     * Add documentosRecibidos
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentosRecibidos
     * @return Departamento
     */
    public function addDocumentosRecibido(\UNAH\SGOBundle\Entity\Documento $documentosRecibidos)
    {
        $this->documentosRecibidos[] = $documentosRecibidos;

        return $this;
    }

    /**
     * Remove documentosRecibidos
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentosRecibidos
     */
    public function removeDocumentosRecibido(\UNAH\SGOBundle\Entity\Documento $documentosRecibidos)
    {
        $this->documentosRecibidos->removeElement($documentosRecibidos);
    }

    /**
     * Get documentosRecibidos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentosRecibidos()
    {
        return $this->documentosRecibidos;
    }

    /**
     * Add documentosEnviados
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentosEnviados
     * @return Departamento
     */
    public function addDocumentosEnviado(\UNAH\SGOBundle\Entity\Documento $documentosEnviados)
    {
        $this->documentosEnviados[] = $documentosEnviados;

        return $this;
    }

    /**
     * Remove documentosEnviados
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentosEnviados
     */
    public function removeDocumentosEnviado(\UNAH\SGOBundle\Entity\Documento $documentosEnviados)
    {
        $this->documentosEnviados->removeElement($documentosEnviados);
    }

    /**
     * Get documentosEnviados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentosEnviados()
    {
        return $this->documentosEnviados;
    }

    /**
     * Add documentos
     *
     * @param \UNAH\SGOBundle\Entity\Documento $documentos
     * @return Departamento
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
     * @return Departamento
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
}
