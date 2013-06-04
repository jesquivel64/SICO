<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoAccion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TipoAccion
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
     * @ORM\OneToMany(targetEntity="Accion", mappedBy="tipo")
     */
    protected $acciones;
    
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
     * @return TipoAccion
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
     * @return TipoAccion
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
        $this->acciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add acciones
     *
     * @param \UNAH\SGOBundle\Entity\Accion $acciones
     * @return TipoAccion
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
}
