<?php

namespace Cleantech\DirectorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mensaje
 *
 * @ORM\Table(name="mensaje")
 * @ORM\Entity(repositoryClass="Cleantech\DirectorioBundle\Entity\MensajeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Mensaje
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="mensaje")
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
    private $nombreMensaje;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

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
     * Set nombreMensaje
     *
     * @param string $nombreMensaje
     * @return Mensaje
     */
    public function setNombreMensaje($nombreMensaje)
    {
        $this->nombreMensaje = $nombreMensaje;

        return $this;
    }

    /**
     * Get nombreMensaje
     *
     * @return string 
     */
    public function getNombreMensaje()
    {
        return $this->nombreMensaje;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Mensaje
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Mensaje
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
     * @return Mensaje
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
}
