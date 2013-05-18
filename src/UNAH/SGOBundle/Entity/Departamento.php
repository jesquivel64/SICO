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
     * @param \UNAH\SGOBundle\Entity\DocumentoRecibido $documentosRecibidos
     * @return Departamento
     */
    public function addDocumentosRecibido(\UNAH\SGOBundle\Entity\DocumentoRecibido $documentosRecibidos)
    {
        $this->documentosRecibidos[] = $documentosRecibidos;

        return $this;
    }

    /**
     * Remove documentosRecibidos
     *
     * @param \UNAH\SGOBundle\Entity\DocumentoRecibido $documentosRecibidos
     */
    public function removeDocumentosRecibido(\UNAH\SGOBundle\Entity\DocumentoRecibido $documentosRecibidos)
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
     * @param \UNAH\SGOBundle\Entity\DocumentoEnviado $documentosEnviados
     * @return Departamento
     */
    public function addDocumentosEnviado(\UNAH\SGOBundle\Entity\DocumentoEnviado $documentosEnviados)
    {
        $this->documentosEnviados[] = $documentosEnviados;

        return $this;
    }

    /**
     * Remove documentosEnviados
     *
     * @param \UNAH\SGOBundle\Entity\DocumentoEnviado $documentosEnviados
     */
    public function removeDocumentosEnviado(\UNAH\SGOBundle\Entity\DocumentoEnviado $documentosEnviados)
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
}
