<?php
// src/Acatism/MainBundle/Document/Student.php

namespace Acatism\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Acatism\MainBundle\Form\Type\StudentAboutType;
use Acatism\MainBundle\Form\Type\StudentCvType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
* Acatism\MainBundle\Document\Student
*
* @MongoDB\Document
*/

class Student extends Person
{
    
	/**
	* @MongoDB\Field(type="string")
	*/
	protected $year_of_study;

	/**
	* @MongoDB\Field(type="string")
	*/
	protected $group;

	
    /**
    * @MongoDB\Field(type="string")
    */
    protected $prog_languages;

    /**
    * @MongoDB\Field(type="string")
    */
    protected $prog_technologies;

    /**
    * @MongoDB\Field(type="string")
    */
    protected $projects;

    /**
    * @MongoDB\Field(type="boolean")
    */
    protected $isAccepted;

     public function __construct()
    {
        $this->isAccepted = false;
  
    }


     public function createAboutForm(Controller $controller)
    {
        return $controller->createForm(new StudentAboutType(), $this);
    }
    public function createCvForm(Controller $controller)
    {
        return $controller->createForm(new StudentCvType(), $this);
    }
    /**
     * @var string $university
     */
    protected $university;

    /**
     * @var string $faculty
     */
    protected $faculty;

    /**
     * @var string $phone
     */
    protected $phone;

    /**
     * @var string $website
     */
    protected $website;

    /**
     * @var string $domains
     */
    protected $domains;

    /**
     * @var string $languages
     */
    protected $languages;

    /**
     * @var string $cvPath
     */
    protected $cvPath;

    /**
     * @var string $profilePath
     */
    protected $profilePath;

    /**
     * @var Acatism\AuthenticationBundle\Document\User
     */
    protected $user;

    /**
    * @var UploadedFile $profileFile
    */
    protected $profileFile;

    /**
    * @var UploadedFile $cvFile
    */
    protected $cvFile;


    /**
     * Set yearOfStudy
     *
     * @param string $yearOfStudy
     * @return self
     */
    public function setYearOfStudy($yearOfStudy)
    {
        $this->year_of_study = $yearOfStudy;
        return $this;
    }

    /**
     * Get yearOfStudy
     *
     * @return string $yearOfStudy
     */
    public function getYearOfStudy()
    {
        return $this->year_of_study;
    }

    /**
     * Set group
     *
     * @param string $group
     * @return self
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * Get group
     *
     * @return string $group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set progLanguages
     *
     * @param string $progLanguages
     * @return self
     */
    public function setProgLanguages($progLanguages)
    {
        $this->prog_languages = $progLanguages;
        return $this;
    }

    /**
     * Get progLanguages
     *
     * @return string $progLanguages
     */
    public function getProgLanguages()
    {
        return $this->prog_languages;
    }

    /**
     * Set progTechnologies
     *
     * @param string $progTechnologies
     * @return self
     */
    public function setProgTechnologies($progTechnologies)
    {
        $this->prog_technologies = $progTechnologies;
        return $this;
    }

    /**
     * Get progTechnologies
     *
     * @return string $progTechnologies
     */
    public function getProgTechnologies()
    {
        return $this->prog_technologies;
    }

    /**
     * Set projects
     *
     * @param string $projects
     * @return self
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;
        return $this;
    }

    /**
     * Get projects
     *
     * @return string $projects
     */
    public function getProjects()
    {
        return $this->projects;
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
     * Set university
     *
     * @param string $university
     * @return self
     */
    public function setUniversity($university)
    {
        $this->university = $university;
        return $this;
    }

    /**
     * Get university
     *
     * @return string $university
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * Set faculty
     *
     * @param string $faculty
     * @return self
     */
    public function setFaculty($faculty)
    {
        $this->faculty = $faculty;
        return $this;
    }

    /**
     * Get faculty
     *
     * @return string $faculty
     */
    public function getFaculty()
    {
        return $this->faculty;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get phone
     *
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return self
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * Get website
     *
     * @return string $website
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set domains
     *
     * @param string $domains
     * @return self
     */
    public function setDomains($domains)
    {
        $this->domains = $domains;
        return $this;
    }

    /**
     * Get domains
     *
     * @return string $domains
     */
    public function getDomains()
    {
        return $this->domains;
    }

    /**
     * Set languages
     *
     * @param string $languages
     * @return self
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
        return $this;
    }

    /**
     * Get languages
     *
     * @return string $languages
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set cvPath
     *
     * @param string $cvPath
     * @return self
     */
    public function setCvPath($cvPath)
    {
        $this->cvPath = $cvPath;
        return $this;
    }

    /**
     * Get cvPath
     *
     * @return string $cvPath
     */
    public function getCvPath()
    {
        return $this->cvPath;
    }

    /**
     * Set profilePath
     *
     * @param string $profilePath
     * @return self
     */
    public function setProfilePath($profilePath)
    {
        $this->profilePath = $profilePath;
        return $this;
    }

    /**
     * Get profilePath
     *
     * @return string $profilePath
     */
    public function getProfilePath()
    {
        return $this->profilePath;
    }

    /**
     * Get profileFile
     *
     * @return UploadedFile
     */

    public function getProfileFile()
    {
        return $this->profileFile;
    }

    /**
     * Get profileFile
     *
     * @return UploadedFile
     */

    public function getCvFile()
    {
        return $this->cvFile;
    }

    /**
     * Set profileFile
     *
     * @param UploadedFile $file
     * @return Person
     */

    public function setProfileFile(UploadedFile $file)
    {
        $this->profileFile = $file;
        return $this;
    }

    /**
     * Set profileFile
     *
     * @param UploadedFile $file
     * @return Person
     */


    public function setCvFile(UploadedFile $file)
    {
        $this->cvFile = $file;
        return $this;
    }
    /**
     * @var $id
     */
    protected $id;


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
}
