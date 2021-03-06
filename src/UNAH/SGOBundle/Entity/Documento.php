<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

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
     */
    protected $tipo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Coordinacion", inversedBy="documentos")
     */
    protected $coordinacion;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoSolicitud", inversedBy="documentos")
     */
    protected $tipoSolicitud;
    
    /**
     * @ORM\ManyToOne(targetEntity="Centro", inversedBy="documentos")
     */
    protected $centro;
    /**
     * @ORM\ManyToOne(targetEntity="Instancia", inversedBy="documentos")
     */
    protected $instancia;
    
    /**
     * @ORM\ManyToOne(targetEntity="Facultad", inversedBy="documentos")
     */
    protected $facultad;
    /**
     * @ORM\ManyToOne(targetEntity="Carrera", inversedBy="documentos")
     */
    protected $carrera;
    
    /**
     * @ORM\ManyToMany(targetEntity="Departamento", inversedBy="documentosEnviados")
     * @ORM\JoinTable(name="enviado_departamento")
     */
    protected $receptores;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    protected $numero;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
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
     * @ORM\Column(name="destinatario", type="text",  nullable=true)
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_de_respuesta", type="datetime", nullable=true)
     */
    protected $fechaDeRespuesta;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo", type="integer")
     */
    protected $tiempo;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="respondido", type="boolean", nullable=true)
     */
    protected $respondido = FALSE;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="recibido", type="boolean")
     */
    protected $recibido = FALSE;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="responder", type="boolean", nullable=true)
     */
    protected $responder = FALSE;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="clasificar", type="boolean", nullable=true)
     */
    protected $clasificar = FALSE;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="copia", type="boolean", nullable=true)
     */
    protected $copia = FALSE;
    
    /**
     * @ORM\OneToMany(targetEntity="Adjunto", mappedBy="documento")
     */
    protected $adjuntos;
    
    /**
     * @ORM\OneToMany(targetEntity="Accion", mappedBy="documento")
     */
    protected $acciones;
    
    /**
     * @ORM\OneToMany(targetEntity="Comentario", mappedBy="documento")
     */
    protected $comentarios;
    
    /**
     * @ORM\ManyToMany(targetEntity="Documento", inversedBy="respuestas")
     * @ORM\JoinTable(name="documento_respuesta",
     *      joinColumns={@ORM\JoinColumn(name="documento_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="respuesta_id", referencedColumnName="id")}
     *      )
     */
    protected $respuestas;
    
    /**
     * @Assert\True(message = "La Fecha de Recepción no puede ser mayor que el día de hoy")
     */
    public function isFechaDeRecibidoValid()
    {
        $now = new \DateTime();
        return ($this->fechaDeRecibido <= $now);
    }
    
    /**
     * @Assert\True(message = "La Fecha de Emisión no puede ser mayor que el día de hoy")
     */
    public function isFechaDeEmisionValid()
    {
        $now = new \DateTime();
        return ($this->fechaDeEmision <= $now);
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

    /**
     * Set fechaDeRespuesta
     *
     * @param \DateTime $fechaDeRespuesta
     * @return Documento
     */
    public function setFechaDeRespuesta($fechaDeRespuesta)
    {
        $this->fechaDeRespuesta = $fechaDeRespuesta;
        $delta = $this->fechaDeRespuesta->diff($this->fechaDeRecibido);
        $this->tiempo = $delta->i + ($delta->h * 60 * 60)
                                  + ($delta->d * 60 * 60 * 24)
                                  + ($delta->m * 60 * 60 * 24 * 30)
                                  + ($delta->y * 60 * 60 * 24 * 365);
        return $this;
    }

    /**
     * Get fechaDeRespuesta
     *
     * @return \DateTime 
     */
    public function getFechaDeRespuesta()
    {
        return $this->fechaDeRespuesta;
    }

    /**
     * Set responder
     *
     * @param boolean $responder
     * @return Documento
     */
    public function setResponder($responder)
    {
        $this->responder = $responder;

        return $this;
    }

    /**
     * Get responder
     *
     * @return boolean 
     */
    public function getResponder()
    {
        return $this->responder;
    }

    /**
     * Set gca
     *
     * @param boolean $gca
     * @return Documento
     */
    public function setGca($gca)
    {
        $this->gca = $gca;

        return $this;
    }

    /**
     * Get gca
     *
     * @return boolean 
     */
    public function getGca()
    {
        return $this->gca;
    }

    /**
     * Set tipoSolicitud
     *
     * @param \UNAH\SGOBundle\Entity\TipoSolicitud $tipoSolicitud
     * @return Documento
     */
    public function setTipoSolicitud(\UNAH\SGOBundle\Entity\TipoSolicitud $tipoSolicitud = null)
    {
        $this->tipoSolicitud = $tipoSolicitud;

        return $this;
    }

    /**
     * Get tipoSolicitud
     *
     * @return \UNAH\SGOBundle\Entity\TipoSolicitud 
     */
    public function getTipoSolicitud()
    {
        return $this->tipoSolicitud;
    }
    
    public function getTiempoRespuesta() {
        $interval = $this->fechaDeRespuesta->diff($this->fechaDeRecibido);
        return $interval->format("%m meses %d dias %h horas %i minutos");
    }
    
    public function getTiempoIngreso()
    {
        $now = new \DateTime();
        $interval = $now->diff($this->fechaDeRecibido);
        return $interval->format("%m meses %d dias %h horas %i minutos");
    }

    /**
     * Set clasificar
     *
     * @param boolean $clasificar
     * @return Documento
     */
    public function setClasificar($clasificar)
    {
        $this->clasificar = $clasificar;

        return $this;
    }

    /**
     * Get clasificar
     *
     * @return boolean 
     */
    public function getClasificar()
    {
        return $this->clasificar;
    }

    /**
     * Add acciones
     *
     * @param \UNAH\SGOBundle\Entity\Accion $acciones
     * @return Documento
     */
    public function addAccione(\UNAH\SGOBundle\Entity\Accion $acciones)
    {
        $this->acciones[] = $acciones;

        return $this;
    }

    /**
     * Remove acciones
     *
     * @param \UNAH\SGOBundle\Entity\Accion $acciones
     */
    public function removeAccione(\UNAH\SGOBundle\Entity\Accion $acciones)
    {
        $this->acciones->removeElement($acciones);
    }

    /**
     * Get acciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAcciones()
    {
        return $this->acciones;
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
        $this->acciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fechaDeRecibido = new \DateTime();
        $this->fechaDeEmision = new \DateTime();
        $this->fechaDeEnvio = new \DateTime();
        $this->tiempo = 0;
    }


    /**
     * Set copia
     *
     * @param boolean $copia
     * @return Documento
     */
    public function setCopia($copia)
    {
        $this->copia = $copia;

        return $this;
    }

    /**
     * Get copia
     *
     * @return boolean 
     */
    public function getCopia()
    {
        return $this->copia;
    }

    /**
     * Set tiempo
     *
     * @param integer $tiempo
     * @return Documento
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get tiempo
     *
     * @return integer 
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set coordinacion
     *
     * @param \UNAH\SGOBundle\Entity\Coordinacion $coordinacion
     * @return Documento
     */
    public function setCoordinacion(\UNAH\SGOBundle\Entity\Coordinacion $coordinacion = null)
    {
        $this->coordinacion = $coordinacion;

        return $this;
    }

    /**
     * Get coordinacion
     *
     * @return \UNAH\SGOBundle\Entity\Coordinacion 
     */
    public function getCoordinacion()
    {
        return $this->coordinacion;
    }

    /**
     * Set centro
     *
     * @param \UNAH\SGOBundle\Entity\Centro $centro
     * @return Documento
     */
    public function setCentro(\UNAH\SGOBundle\Entity\Centro $centro = null)
    {
        $this->centro = $centro;

        return $this;
    }

    /**
     * Get centro
     *
     * @return \UNAH\SGOBundle\Entity\Centro 
     */
    public function getCentro()
    {
        return $this->centro;
    }

    /**
     * Set instancia
     *
     * @param \UNAH\SGOBundle\Entity\Instancia $instancia
     * @return Documento
     */
    public function setInstancia(\UNAH\SGOBundle\Entity\Instancia $instancia = null)
    {
        $this->instancia = $instancia;

        return $this;
    }

    /**
     * Get instancia
     *
     * @return \UNAH\SGOBundle\Entity\Instancia 
     */
    public function getInstancia()
    {
        return $this->instancia;
    }

    /**
     * Set facultad
     *
     * @param \UNAH\SGOBundle\Entity\Facultad $facultad
     * @return Documento
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
     * Set carrera
     *
     * @param \UNAH\SGOBundle\Entity\Carrera $carrera
     * @return Documento
     */
    public function setCarrera(\UNAH\SGOBundle\Entity\Carrera $carrera = null)
    {
        $this->carrera = $carrera;

        return $this;
    }

    /**
     * Get carrera
     *
     * @return \UNAH\SGOBundle\Entity\Carrera 
     */
    public function getCarrera()
    {
        return $this->carrera;
    }
}
