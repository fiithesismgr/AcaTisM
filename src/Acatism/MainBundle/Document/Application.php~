<?php

// src/Acatism/MainBundle/Document/Application.php

namespace Acatism\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Acatism\MainBundle\Document\Application
 * @MongoDB\Document
 */
class Application
{
    /**
    * @MongoDB\Id(strategy="AUTO")
    */
    protected $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Acatism\AuthenticationBundle\Document\User")
     */
    protected $professor;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Acatism\AuthenticationBundle\Document\User")
     */
    protected $student;

    /**
    * @MongoDB\Field(type="boolean")
    */
    protected $isAccepted;

    /**
    * @MongoDB\Field(type="boolean")
    */
    protected $isConfirmed;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set professor
     *
     * @param Acatism\AuthenticationBundle\Document\User $professor
     * @return self
     */
    public function setProfessor(\Acatism\AuthenticationBundle\Document\User $professor)
    {
        if($professor->getRole()->getRole() === 'ROLE_PROFESSOR')
        {
            $this->professor = $professor;
        }
        
        return $this;
    }

    /**
     * Get professor
     *
     * @return Acatism\AuthenticationBundle\Document\User $professor
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * Set student
     *
     * @param Acatism\AuthenticationBundle\Document\User $student
     * @return self
     */
    public function setStudent(\Acatism\AuthenticationBundle\Document\User $student)
    {
        if($student->getRole()->getRole() === 'ROLE_STUDENT')
        {
            $this->student = $student;
        }
        return $this;
    }

    /**
     * Get student
     *
     * @return Acatism\AuthenticationBundle\Document\User $student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set isAccepted
     *
     * @param boolean $isAccepted
     * @return self
     */
    public function setIsAccepted($isAccepted)
    {
        $this->isAccepted = $isAccepted;
        return $this;
    }

    /**
     * Get isAccepted
     *
     * @return boolean $isAccepted
     */
    public function getIsAccepted()
    {
        return $this->isAccepted;
    }

    /**
     * Set isConfirmed
     *
     * @param boolean $isConfirmed
     * @return self
     */
    public function setIsConfirmed($isConfirmed)
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }

    /**
     * Get isConfirmed
     *
     * @return boolean $isConfirmed
     */
    public function getIsConfirmed()
    {
        return $this->isConfirmed;
    }
}
