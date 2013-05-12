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
     * @ORM\OneToMany(targetEntity="Oficio", mappedBy="emisor")
     */
    protected $oficios;
    
    /**
     * @ORM\ManyToMany(targetEntity="DocumentoSalida", inversedBy="departamentos")
     */
    private $documentosEnviados;

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

    public function __construct()
    {
        $this->oficios = new ArrayCollection();
    }

    /**
     * Add oficios
     *
     * @param \UNAH\SGOBundle\Entity\Oficio $oficios
     * @return Departamento
     */
    public function addOficio(\UNAH\SGOBundle\Entity\Oficio $oficios)
    {
        $this->oficios[] = $oficios;
    
        return $this;
    }

    /**
     * Remove oficios
     *
     * @param \UNAH\SGOBundle\Entity\Oficio $oficios
     */
    public function removeOficio(\UNAH\SGOBundle\Entity\Oficio $oficios)
    {
        $this->oficios->removeElement($oficios);
    }

    /**
     * Get oficios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOficios()
    {
        return $this->oficios;
    }
	
	public function __toString()
	{
		return $this->nombre;
	}

    /**
     * Add documentosEnviados
     *
     * @param \UNAH\SGOBundle\Entity\DocumentosSalida $documentosEnviados
     * @return Departamento
     */
    public function addDocumentosEnviado(\UNAH\SGOBundle\Entity\DocumentoSalida $documentosEnviados)
    {
        $this->documentosEnviados[] = $documentosEnviados;

        return $this;
    }

    /**
     * Remove documentosEnviados
     *
     * @param \UNAH\SGOBundle\Entity\DocumentosSalida $documentosEnviados
     */
    public function removeDocumentosEnviado(\UNAH\SGOBundle\Entity\DocumentoSalida $documentosEnviados)
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
