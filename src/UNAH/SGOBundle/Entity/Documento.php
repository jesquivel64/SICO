<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documento
 * @ORM\Entity
 * @ORM\Table()
 */
class Documento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoDocumento", inversedBy="documentos")
     * @ORM\JoinColumn(name="tipo_documento_id", referencedColumnName="id")
     */
    protected $tipo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    protected $numero;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    protected $descripcion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="autor", type="string", length=255, nullable=true)
     */
    protected $autor;
    
    /**
     * @var string
     *
     * @ORM\Column(name="entregado", type="string", length=255, nullable=TRUE)
     */
    protected $entregado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="destinatario", type="string", length=255, nullable=true)
     */
    protected $destinatario;
    
    /**
     * @var string
     *
     * @ORM\Column(name="recibio", type="string", length=255, nullable=true)
     */
    protected $recibio;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_emision", type="datetime", nullable=true)
     */
    protected $fechaDeEmision;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_envio", type="datetime", nullable=true)
     */
    protected $fechaDeEnvio;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_recibido", type="datetime", nullable=true)
     */
    protected $fechaDeRecibido;
    
    /**
     * @ORM\OneToMany(targetEntity="Adjunto", mappedBy="documento")
     */
    protected $adjuntos;
    
    /**
     * @ORM\OneToMany(targetEntity="Comentario", mappedBy="documento")
     */
    protected $comentarios;
    
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=true)
     */
    protected $estado;
    
    /**
     * @ORM\ManyToOne(targetEntity="Departamento", inversedBy="documentosRecibidos")
     * @ORM\JoinColumn(name="emisor_id", referencedColumnName="id")
     */
    protected $emisor;
    
    /**
     * @ORM\ManyToMany(targetEntity="Departamento", inversedBy="documentosEnviados")
     * @ORM\JoinTable(name="enviado_departamento")
     */
    protected $receptores;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="respondido", type="boolean")
     */
    protected $respondido = FALSE;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="recibido", type="boolean")
     */
    protected $recibido = FALSE;
    /**
     * @ORM\ManyToMany(targetEntity="Documento", inversedBy="respuestas")
     * @ORM\JoinTable(name="documento_respuesta",
     *      joinColumns={@ORM\JoinColumn(name="documento_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="respuesta_id", referencedColumnName="id")}
     *      )
     */
    private $respuestas;

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
     * @return Documento
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
     * @return Documento
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
     * Set autor
     *
     * @param string $autor
     * @return Documento
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string 
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set entregado
     *
     * @param string $entregado
     * @return Documento
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
     * Set destinatario
     *
     * @param string $destinatario
     * @return Documento
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
     * Set recibio
     *
     * @param string $recibio
     * @return Documento
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
     * Set fechaDeEmision
     *
     * @param \DateTime $fechaDeEmision
     * @return Documento
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
     * @return Documento
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
     * @return Documento
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
     * Set estado
     *
     * @param string $estado
     * @return Documento
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipo
     *
     * @param \UNAH\SGOBundle\Entity\TipoDocumento $tipo
     * @return Documento
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
     * @param \UNAH\SGOBundle\Entity\Adjunto $adjuntos
     * @return Documento
     */
    public function addAdjunto(\UNAH\SGOBundle\Entity\Adjunto $adjuntos)
    {
        $this->adjuntos[] = $adjuntos;

        return $this;
    }

    /**
     * Remove adjuntos
     *
     * @param \UNAH\SGOBundle\Entity\Adjunto $adjuntos
     */
    public function removeAdjunto(\UNAH\SGOBundle\Entity\Adjunto $adjuntos)
    {
        $this->adjuntos->removeElement($adjuntos);
    }

    /**
     * Get adjuntos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdjuntos()
    {
        return $this->adjuntos;
    }

    /**
     * Add comentarios
     *
     * @param \UNAH\SGOBundle\Entity\Comentario $comentarios
     * @return Documento
     */
    public function addComentario(\UNAH\SGOBundle\Entity\Comentario $comentarios)
    {
        $this->comentarios[] = $comentarios;

        return $this;
    }

    /**
     * Remove comentarios
     *
     * @param \UNAH\SGOBundle\Entity\Comentario $comentarios
     */
    public function removeComentario(\UNAH\SGOBundle\Entity\Comentario $comentarios)
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

    /**
     * Set respondido
     *
     * @param boolean $respondido
     * @return Documento
     */
    public function setRespondido($respondido)
    {
        $this->respondido = $respondido;

        return $this;
    }

    /**
     * Get respondido
     *
     * @return boolean 
     */
    public function getRespondido()
    {
        return $this->respondido;
    }

    /**
     * Set recibido
     *
     * @param boolean $recibido
     * @return Documento
     */
    public function setRecibido($recibido)
    {
        $this->recibido = $recibido;

        return $this;
    }

    /**
     * Get recibido
     *
     * @return boolean 
     */
    public function getRecibido()
    {
        return $this->recibido;
    }

    /**
     * Set emisor
     *
     * @param \UNAH\SGOBundle\Entity\Departamento $emisor
     * @return Documento
     */
    public function setEmisor(\UNAH\SGOBundle\Entity\Departamento $emisor = null)
    {
        $this->emisor = $emisor;

        return $this;
    }

    /**
     * Get emisor
     *
     * @return \UNAH\SGOBundle\Entity\Departamento 
     */
    public function getEmisor()
    {
        return $this->emisor;
    }

    /**
     * Add receptores
     *
     * @param \UNAH\SGOBundle\Entity\Departamento $receptores
     * @return Documento
     */
    public function addReceptore(\UNAH\SGOBundle\Entity\Departamento $receptores)
    {
        $this->receptores[] = $receptores;

        return $this;
    }

    /**
     * Remove receptores
     *
     * @param \UNAH\SGOBundle\Entity\Departamento $receptores
     */
    public function removeReceptore(\UNAH\SGOBundle\Entity\Departamento $receptores)
    {
        $this->receptores->removeElement($receptores);
    }

    /**
     * Get receptores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReceptores()
    {
        return $this->receptores;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adjuntos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comentarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->receptores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->respuestas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add respuestas
     *
     * @param \UNAH\SGOBundle\Entity\Documento $respuestas
     * @return Documento
     */
    public function addRespuesta(\UNAH\SGOBundle\Entity\Documento $respuesta)
    {
        $this->respuestas[] = $respuesta;
        return $this;
    }

    /**
     * Remove respuestas
     *
     * @param \UNAH\SGOBundle\Entity\Documento $respuestas
     */
    public function removeRespuesta(\UNAH\SGOBundle\Entity\Documento $respuesta)
    {
        $this->respuestas->removeElement($respuesta);
    }

    /**
     * Get respuestas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }
}
