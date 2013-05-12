<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoSalida
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DocumentoSalida
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
     * @ORM\ManyToOne(targetEntity="TipoDocumento", inversedBy="documentosSalida")
     * @ORM\JoinColumn(name="tipo_documento_id", referencedColumnName="id")
     */
    private $tipo;
    
    /**
     * @ORM\ManyToMany(targetEntity="Departamento", mappedBy="documentosEnviados")
     */
    private $departamentos;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="recibio", type="string", length=255)
     */
    private $recibio;

    /**
     * @var string
     *
     * @ORM\Column(name="remitente", type="string", length=255)
     */
    private $remitente;

    /**
     * @var string
     *
     * @ORM\Column(name="destinatario", type="string", length=255)
     */
    private $destinatario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_emision", type="datetime")
     */
    private $fechaDeEmision;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_envio", type="datetime")
     */
    private $fechaDeEnvio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_recibido", type="datetime")
     */
    private $fechaDeRecibido;
    
    /**
     * @ORM\OneToMany(targetEntity="AdjuntoSalida", mappedBy="documento")
     */
    protected $adjuntos;
    
    /**
     * @ORM\OneToMany(targetEntity="ComentarioSalida", mappedBy="documento")
     */
    protected $comentarios;

    /**
     * @var string
     *
     * @ORM\Column(name="entregado", type="string", length=255)
     */
    private $entregado;


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
     * @param string $numero
     * @return DocumentoSalida
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return DocumentoSalida
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
     * Set recibio
     *
     * @param string $recibio
     * @return DocumentoSalida
     */
    public function setRecibio($recibio)
    {
        $this->recibio = $recibio;

        return $this;
    }

    /**
     * Get recibio
     *
     * @return string 
     */
    public function getRecibio()
    {
        return $this->recibio;
    }

    /**
     * Set remitente
     *
     * @param string $remitente
     * @return DocumentoSalida
     */
    public function setRemitente($remitente)
    {
        $this->remitente = $remitente;

        return $this;
    }

    /**
     * Get remitente
     *
     * @return string 
     */
    public function getRemitente()
    {
        return $this->remitente;
    }

    /**
     * Set destinatario
     *
     * @param string $destinatario
     * @return DocumentoSalida
     */
    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;

        return $this;
    }

    /**
     * Get destinatario
     *
     * @return string 
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }

    /**
     * Set fechaDeEmision
     *
     * @param \DateTime $fechaDeEmision
     * @return DocumentoSalida
     */
    public function setFechaDeEmision($fechaDeEmision)
    {
        $this->fechaDeEmision = $fechaDeEmision;

        return $this;
    }

    /**
     * Get fechaDeEmision
     *
     * @return \DateTime 
     */
    public function getFechaDeEmision()
    {
        return $this->fechaDeEmision;
    }

    /**
     * Set fechaDeEnvio
     *
     * @param \DateTime $fechaDeEnvio
     * @return DocumentoSalida
     */
    public function setFechaDeEnvio($fechaDeEnvio)
    {
        $this->fechaDeEnvio = $fechaDeEnvio;

        return $this;
    }

    /**
     * Get fechaDeEnvio
     *
     * @return \DateTime 
     */
    public function getFechaDeEnvio()
    {
        return $this->fechaDeEnvio;
    }

    /**
     * Set fechaDeRecibido
     *
     * @param \DateTime $fechaDeRecibido
     * @return DocumentoSalida
     */
    public function setFechaDeRecibido($fechaDeRecibido)
    {
        $this->fechaDeRecibido = $fechaDeRecibido;

        return $this;
    }

    /**
     * Get fechaDeRecibido
     *
     * @return \DateTime 
     */
    public function getFechaDeRecibido()
    {
        return $this->fechaDeRecibido;
    }

    /**
     * Set adjuntos
     *
     * @param array $adjuntos
     * @return DocumentoSalida
     */
    public function setAdjuntos($adjuntos)
    {
        $this->adjuntos = $adjuntos;

        return $this;
    }

    /**
     * Get adjuntos
     *
     * @return array 
     */
    public function getAdjuntos()
    {
        return $this->adjuntos;
    }

    /**
     * Set entregado
     *
     * @param string $entregado
     * @return DocumentoSalida
     */
    public function setEntregado($entregado)
    {
        $this->entregado = $entregado;

        return $this;
    }

    /**
     * Get entregado
     *
     * @return string 
     */
    public function getEntregado()
    {
        return $this->entregado;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adjuntos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set tipo
     *
     * @param \UNAH\SGOBundle\Entity\TipoDocumento $tipo
     * @return DocumentoSalida
     */
    public function setTipo(\UNAH\SGOBundle\Entity\TipoDocumento $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \UNAH\SGOBundle\Entity\TipoDocumento 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Add adjuntos
     *
     * @param \UNAH\SGOBundle\Entity\AdjuntoSalida $adjuntos
     * @return DocumentoSalida
     */
    public function addAdjunto(\UNAH\SGOBundle\Entity\AdjuntoSalida $adjuntos)
    {
        $this->adjuntos[] = $adjuntos;

        return $this;
    }

    /**
     * Remove adjuntos
     *
     * @param \UNAH\SGOBundle\Entity\AdjuntoSalida $adjuntos
     */
    public function removeAdjunto(\UNAH\SGOBundle\Entity\AdjuntoSalida $adjuntos)
    {
        $this->adjuntos->removeElement($adjuntos);
    }

    /**
     * Add departamentos
     *
     * @param \UNAH\SGOBundle\Entity\Departamento $departamentos
     * @return DocumentoSalida
     */
    public function addDepartamento(\UNAH\SGOBundle\Entity\Departamento $departamentos)
    {
        $this->departamentos[] = $departamentos;

        return $this;
    }

    /**
     * Remove departamentos
     *
     * @param \UNAH\SGOBundle\Entity\Departamento $departamentos
     */
    public function removeDepartamento(\UNAH\SGOBundle\Entity\Departamento $departamentos)
    {
        $this->departamentos->removeElement($departamentos);
    }

    /**
     * Get departamentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartamentos()
    {
        return $this->departamentos;
    }

    /**
     * Add comentarios
     *
     * @param \UNAH\SGOBundle\Entity\ComentarioSalida $comentarios
     * @return DocumentoSalida
     */
    public function addComentario(\UNAH\SGOBundle\Entity\ComentarioSalida $comentarios)
    {
        $this->comentarios[] = $comentarios;

        return $this;
    }

    /**
     * Remove comentarios
     *
     * @param \UNAH\SGOBundle\Entity\ComentarioSalida $comentarios
     */
    public function removeComentario(\UNAH\SGOBundle\Entity\ComentarioSalida $comentarios)
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
}
