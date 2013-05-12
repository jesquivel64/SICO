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
     * @ORM\ManyToOne(targetEntity="DocumentoSalida", inversedBy="tipoDocumento")
     * @ORM\JoinColumn(name="tipo_documento_id", referencedColumnName="id")
     */
    private $documentosSalida;

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
     * Set documentosSalida
     *
     * @param \UNAH\SGOBundle\Entity\DocumentoSalida $documentosSalida
     * @return TipoDocumento
     */
    public function setDocumentosSalida(\UNAH\SGOBundle\Entity\DocumentoSalida $documentosSalida = null)
    {
        $this->documentosSalida = $documentosSalida;

        return $this;
    }

    /**
     * Get documentosSalida
     *
     * @return \UNAH\SGOBundle\Entity\DocumentoSalida 
     */
    public function getDocumentosSalida()
    {
        return $this->documentosSalida;
    }
    
    public function __toString()
    {
        return $this->nombre;
    }
}
