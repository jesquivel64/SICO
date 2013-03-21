<?php

namespace UNAH\SGOBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Adjunto
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\ManyToOne(targetEntity="Oficio", inversedBy="comentarios")
     * @ORM\JoinColumn(name="oficio_id", referencedColumnName="id")
     */
    private $oficio;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    public $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
	
	/**
     * @Assert\File(maxSize="6000000")
     */
    public $file;
	
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->id.'.'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }
	
	private $filenameForRemove;

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            $this->path = $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $this->file->move(
            $this->getUploadRootDir(),
            $this->file->getClientOriginalName()
        );
		$this->path = $this->file->getClientOriginalName();

        unset($this->file);
    }
	
    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->filenameForRemove = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->filenameForRemove) {
            unlink($this->filenameForRemove);
        }
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
     * @return Adjunto
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
     * Set path
     *
     * @param string $path
     * @return Adjunto
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set oficio
     *
     * @param \UNAH\SGOBundle\Entity\Oficio $oficio
     * @return Adjunto
     */
    public function setOficio(\UNAH\SGOBundle\Entity\Oficio $oficio = null)
    {
        $this->oficio = $oficio;
    
        return $this;
    }

    /**
     * Get oficio
     *
     * @return \UNAH\SGOBundle\Entity\Oficio 
     */
    public function getOficio()
    {
        return $this->oficio;
    }
}