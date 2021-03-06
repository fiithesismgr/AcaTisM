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
     * @MongoDB\ReferenceOne(targetDocument="Acatism\MainBundle\Document\Project")
     */

    protected $project;

    /**
    * @MongoDB\Field(type="string")
    */
    protected $status;

     public function __construct()
    {
        $this->status = 'UNPROCESSED';
  
    }

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
     * Set project
     *
     * @param Acatism\MainBundle\Document\Project $project
     * @return self
     */
    public function setProject(\Acatism\MainBundle\Document\Project $project)
    {
        $this->project = $project;
        return $this;
    }

    /**
     * Get project
     *
     * @return Acatism\MainBundle\Document\Project $project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string $status
     */
    public function getStatus()
    {
        return $this->status;
    }
}
