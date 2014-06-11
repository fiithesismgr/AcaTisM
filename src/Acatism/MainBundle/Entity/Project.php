<?php

// src/Acatism/MainBundle/Entity/Project.php

namespace Acatism\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Acatism\MainBundle\Entity\Project
 * @ORM\Table(name="projects")
 * @ORM\Entity()
 */
class Project
{

/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/

protected $id;

/**
* @ORM\Column(type="string", length=255)
* @Assert\NotBlank()
* @Assert\Length(max = 500)
*/

protected $name;

/**
* @ORM\Column(type="string", length=4096)
* @Assert\NotBlank()
*/

protected $description;

/**
* @ORM\Column(type="integer")
*/

    /**
     * @ORM\ManyToOne(targetEntity="Acatism\AuthenticationBundle\Entity\User")
     */
protected $prof;



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
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prof
     *
     * @param \Acatism\AuthenticationBundle\Entity\User $prof
     * @return Project
     */
    public function setProf(\Acatism\AuthenticationBundle\Entity\User $prof = null)
    {
        $this->prof = $prof;

        return $this;
    }

    /**
     * Get prof
     *
     * @return \Acatism\AuthenticationBundle\Entity\User 
     */
    public function getProf()
    {
        return $this->prof;
    }
}
