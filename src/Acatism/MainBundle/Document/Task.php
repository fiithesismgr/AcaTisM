<?php
// src/Acatism/MainBundle/Document/Task.php

namespace Acatism\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
* Acatism\MainBundle\Document\Task
*
* @MongoDB\Document
*/

class Task
{
    /**
    * @MongoDB\Id(strategy="AUTO")
    */
    protected $id;
    
    /**
    * @MongoDB\ReferenceOne(targetDocument="Acatism\AuthenticationBundle\Document\User")
    */
    protected $user;
    
    /**
    * @MongoDB\Field(type="string")
    */
    protected $title;

    /**
    * @MongoDB\Field(type="string")
    */
    protected $description;

    
    /**
    * @MongoDB\Field(type="date")
    */
    protected $dueDate;

    /**
    * @MongoDB\Field(type="boolean")
    */
    protected $requireFile;

    /**
    * @MongoDB\Field(type="boolean")
    */
    protected $requireFileFormat;

    /**
    * @MongoDB\Field(type="boolean")
    */
    protected $requireSourceCode;

    public function __construct()
    {
        $this->requireFile = false;
        $this->requireFileFormat = false;
        $this->requireSourceCode = false;
  
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
     * Set user
     *
     * @param Acatism\AuthenticationBundle\Document\User $user
     * @return self
     */
    public function setUser(\Acatism\AuthenticationBundle\Document\User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Acatism\AuthenticationBundle\Document\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dueDate
     *
     * @param date $dueDate
     * @return self
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * Get dueDate
     *
     * @return date $dueDate
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set requireFile
     *
     * @param boolean $requireFile
     * @return self
     */
    public function setRequireFile($requireFile)
    {
        $this->requireFile = $requireFile;
        return $this;
    }

    /**
     * Get requireFile
     *
     * @return boolean $requireFile
     */
    public function getRequireFile()
    {
        return $this->requireFile;
    }

    /**
     * Set requireFileFormat
     *
     * @param boolean $requireFileFormat
     * @return self
     */
    public function setRequireFileFormat($requireFileFormat)
    {
        $this->requireFileFormat = $requireFileFormat;
        return $this;
    }

    /**
     * Get requireFileFormat
     *
     * @return boolean $requireFileFormat
     */
    public function getRequireFileFormat()
    {
        return $this->requireFileFormat;
    }

    /**
     * Set requireSourceCode
     *
     * @param boolean $requireSourceCode
     * @return self
     */
    public function setRequireSourceCode($requireSourceCode)
    {
        $this->requireSourceCode = $requireSourceCode;
        return $this;
    }

    /**
     * Get requireSourceCode
     *
     * @return boolean $requireSourceCode
     */
    public function getRequireSourceCode()
    {
        return $this->requireSourceCode;
    }
}
