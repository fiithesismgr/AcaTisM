<?php
// src/Acatism/MainBundle/Document/TaskProgress.php

namespace Acatism\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
* Acatism\MainBundle\Document\TaskProgress
*
* @MongoDB\Document
*/

class TaskProgress
{
    /**
    * @MongoDB\Id(strategy="AUTO")
    */
    protected $id;

    /**
    * @MongoDB\ReferenceOne(targetDocument="Acatism\AuthenticationBundle\Document\User")
    */
    protected $student;
    
    /**
    * @MongoDB\ReferenceOne(targetDocument="Acatism\MainBundle\Document\Task")
    */
    protected $task;
    
    /**
    * @MongoDB\Field(type="hash")
    */
    protected $repository = array();

    /**
    * @MongoDB\Field(type="string")
    */
    protected $filePath;

    protected $file;

    /**
    * @MongoDB\Field(type="date")
    */
    protected $dueDate;

    /**
    * @MongoDB\Field(type="boolean")
    */
    protected $isFinished;

    public function __construct()
    {
        $this->isFinished = false;
    }

    public function upload()
    {
        if(!is_null($this->file))
        {
            $extension = $this->file->guessExtension();
            $directory = __DIR__.'/../../../../web/'.'files/students';
            $path = sha1(uniqid(mt_rand())). '.' . $extension;
            $this->file->move($directory, $path);
            $this->filePath = 'files/students/' . $path;
        }
        $this->file = null;
    }

    /**
     * Set file
     *
     * @param UploadedFile $file
     * @return self
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * Get file
     *
     * @return UploadedFile $file
     */
    public function getFile()
    {
        return $this->file;
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
     * Set student
     *
     * @param Acatism\AuthenticationBundle\Document\User $student
     * @return self
     */
    public function setStudent(\Acatism\AuthenticationBundle\Document\User $student)
    {
        $this->student = $student;
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
     * Set task
     *
     * @param Acatism\MainBundle\Document\Task $task
     * @return self
     */
    public function setTask(\Acatism\MainBundle\Document\Task $task)
    {
        $this->task = $task;
        return $this;
    }

    /**
     * Get task
     *
     * @return Acatism\MainBundle\Document\Task $task
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set repository
     *
     * @param hash $repository
     * @return self
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * Get repository
     *
     * @return hash $repository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Set filePath
     *
     * @param string $filePath
     * @return self
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * Get filePath
     *
     * @return string $filePath
     */
    public function getFilePath()
    {
        return $this->filePath;
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
     * Set isFinished
     *
     * @param boolean $isFinished
     * @return self
     */
    public function setIsFinished($isFinished)
    {
        $this->isFinished = $isFinished;
        return $this;
    }

    /**
     * Get isFinished
     *
     * @return boolean $isFinished
     */
    public function getIsFinished()
    {
        return $this->isFinished;
    }
}
