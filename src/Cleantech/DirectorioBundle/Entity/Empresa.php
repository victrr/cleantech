<?php

namespace Cleantech\DirectorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity(repositoryClass="Cleantech\DirectorioBundle\Entity\EmpresaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Empresa
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="empresa")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
    */
    protected $user;
    
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
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="rama_tecnologica", type="string", length=100)
     */
    private $ramaTecnologica;

    /**
     * @var string
     *
     * @ORM\Column(name="industria", type="string", length=100)
     */
    private $industria;

    /**
     * @var string
     *
     * @ORM\Column(name="calle", type="string", length=255, nullable=true)
     */
    private $calle;
    
    /**
     * @var string
     *
     * @ORM\Column(name="colonia", type="string", length=255, nullable=true)
     */
    private $colonia;

    /**
     * @var string
     *
     * @ORM\Column(name="rfc", type="string", length=200, nullable=true)
     */
    private $rfc;

    /**
     * @var integer
     *
     * @ORM\Column(name="cp", type="integer", nullable=true)
     */
    private $cp;
    
    /**
     * @var string
     *
     * @ORM\Column(name="municipio", type="string", length=250, nullable=true)
     */
    private $municipio;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=100)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefono", type="integer")
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="servicio", type="string", length=130)
     */
    private $servicio;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;
//654546546
    /**
     * @var string
     *
     * @ORM\Column(name="razon_social", type="string", length=250, nullable=true)
     */
    private $rSocial;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=250, nullable=true)
     */
    private $facebook;
    
    /**
     * @var string
     *
     * @ORM\Column(name="linkedin", type="string", length=250, nullable=true)
     */
    private $linkedin;
    
    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=250, nullable=true)
     */
    private $twitter;
    
    
//354164684
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;


    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;
    

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
     * @return Empresa
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
     * Set ramaTecnologica
     *
     * @param string $ramaTecnologica
     * @return Empresa
     */
    public function setRamaTecnologica($ramaTecnologica)
    {
        $this->ramaTecnologica = $ramaTecnologica;

        return $this;
    }

    /**
     * Get ramaTecnologica
     *
     * @return string 
     */
    public function getRamaTecnologica()
    {
        return $this->ramaTecnologica;
    }

    /**
     * Set industria
     *
     * @param string $industria
     * @return Empresa
     */
    public function setIndustria($industria)
    {
        $this->industria = $industria;

        return $this;
    }

    /**
     * Get industria
     *
     * @return string 
     */
    public function getIndustria()
    {
        return $this->industria;
    }

    /**
     * Set calle
     *
     * @param string $calle
     * @return Empresa
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return string 
     */
    public function getCalle()
    {
        return $this->calle;
    }
    
    /**
     * Set colonia
     *
     * @param string $colonia
     * @return Empresa
     */
    public function setColonia($colonia)
    {
        $this->colonia = $colonia;

        return $this;
    }

    /**
     * Get colonia
     *
     * @return string 
     */
    public function getColonia()
    {
        return $this->colonia;
    }
    
    /**
     * Set rfc
     *
     * @param string $rfc
     * @return Empresa
     */
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;

        return $this;
    }

    /**
     * Get rfc
     *
     * @return string 
     */
    public function getRfc()
    {
        return $this->rfc;
    }
    
    /**
     * Set cp
     *
     * @param integer $cp
     * @return Empresa
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return integer 
     */
    public function getCp()
    {
        return $this->cp;
    }
    
    /**
     * Set municipio
     *
     * @param string $municipio
     * @return Empresa
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get municipio
     *
     * @return string 
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }
    
    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Empresa
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }
    
     /**
     * Set linkedin
     *
     * @param string $linkedin
     * @return Empresa
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get linkedin
     *
     * @return string 
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }
    
    
    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Empresa
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
    
    

    /**
     * Set estado
     *
     * @param string $estado
     * @return Empresa
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
     * Set telefono
     *
     * @param integer $telefono
     * @return Empresa
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set servicio
     *
     * @param string $servicio
     * @return Empresa
     */
    public function setServicio($servicio)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return string 
     */
    public function getServicio()
    {
        return $this->servicio;
    }
    
    /**
     * Set servicio
     *
     * @param string $servicio
     * @return Empresa
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    //sjfnsejfnjefn
    
    /**
     * Set rSocial
     *
     * @param string $rSocial
     * @return Empresa
     */
    public function setrSocial($rSocial)
    {
        $this->rSocial = $rSocial;

        return $this;
    }

    /**
     * Get rSocial
     *
     * @return string 
     */
    public function getrSocial()
    {
        return $this->rSocial;
    }
    
    //sklfksefnkefn
    
    
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
    * @ORM\PrePersist
    */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }
    
    /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }
    
    /**
     * Set user 
     * @param \Cleantech\DirectorioBundle\Entity\User
     * @return Empresa
    */
    public function setUser(\Cleantech\DirectorioBundle\Entity\User $user = null)
    {
        $this->user = $user;
        
        return $this;
    }
    
    /**
     *Get user 
     *@return \Cleantech\DirectorioBundle\Entity\User
    */
    public function getUser()
    {
        return $this->user;
    }
    
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
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
        return 'uploads/films';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }
    
        // use the original file name here but you should
        // sanitize it at least to avoid any security issues
    
        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );
    
        // set the path property to the filename where you've saved the file
        $this->path = $this->getFile()->getClientOriginalName();
    
        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
}
