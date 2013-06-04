<?php

namespace UNAH\SGOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoDepartamento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TipoDepartamento
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
     * @ORM\OneToMany(targetEntity="Departamento", mappedBy="tipoDepartamento")
     */
    protected $departamentos;
    
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
     * @return TipoDepartamento
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
     * @return TipoDepartamento
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
        $this->departamentos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add departamentos
     *
     * @param \UNAH\SGOBundle\Entity\Departamento $departamentos
     * @return TipoDepartamento
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
}
