<?php
// src/Acatism/MainBundle/Entity/Student.php

namespace Acatism\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Acatism\MainBundle\Form\Type\StudentAboutType;
use Acatism\MainBundle\Form\Type\StudentCvType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
* Acatism\MainBundle\Entity\Student
*
* @ORM\Entity()
*/

class Student extends Person
{
    
	/**
	* @ORM\Column(type="string", length=5)
	*/
	protected $year_of_study;

	/**
	* @ORM\Column(name="year_group", type="string", length=5)
	*/
	protected $group;

	
    /**
    * @ORM\Column(type="string", length=500)
    */
    protected $prog_languages;

    /**
    * @ORM\Column(type="string", length=500)
    */
    protected $prog_technologies;

    /**
    * @ORM\Column(type="string", length=500)
    */
    protected $projects;

     public function createAboutForm(Controller $controller)
    {
        return $controller->createForm(new StudentAboutType(), $this);
    }
    public function createCvForm(Controller $controller)
    {
        return $controller->createForm(new StudentCvType(), $this);
    }
    /**
     * @var string
     */
    protected $university;

    /**
     * @var string
     */
    protected $faculty;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $website;

    /**
     * @var string
     */
    protected $domains;

    /**
     * @var string
     */
    protected $languages;

    /**
     * @var \Acatism\AuthenticationBundle\Entity\User
     */
    protected $user;


    /**
     * Set year_of_study
     *
     * @param string $yearOfStudy
     * @return Student
     */
    public function setYearOfStudy($yearOfStudy)
    {
        $this->year_of_study = $yearOfStudy;

        return $this;
    }

    /**
     * Get year_of_study
     *
     * @return string 
     */
    public function getYearOfStudy()
    {
        return $this->year_of_study;
    }

    /**
     * Set group
     *
     * @param string $group
     * @return Student
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return string 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set prog_languages
     *
     * @param string $progLanguages
     * @return Student
     */
    public function setProgLanguages($progLanguages)
    {
        $this->prog_languages = $progLanguages;

        return $this;
    }

    /**
     * Get prog_languages
     *
     * @return string 
     */
    public function getProgLanguages()
    {
        return $this->prog_languages;
    }

    /**
     * Set prog_technologies
     *
     * @param string $progTechnologies
     * @return Student
     */
    public function setProgTechnologies($progTechnologies)
    {
        $this->prog_technologies = $progTechnologies;

        return $this;
    }

    /**
     * Get prog_technologies
     *
     * @return string 
     */
    public function getProgTechnologies()
    {
        return $this->prog_technologies;
    }

    /**
     * Set projects
     *
     * @param string $projects
     * @return Student
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;

        return $this;
    }

    /**
     * Get projects
     *
     * @return string 
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Set university
     *
     * @param string $university
     * @return Student
     */
    public function setUniversity($university)
    {
        $this->university = $university;

        return $this;
    }

    /**
     * Get university
     *
     * @return string 
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * Set faculty
     *
     * @param string $faculty
     * @return Student
     */
    public function setFaculty($faculty)
    {
        $this->faculty = $faculty;

        return $this;
    }

    /**
     * Get faculty
     *
     * @return string 
     */
    public function getFaculty()
    {
        return $this->faculty;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Student
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Student
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set domains
     *
     * @param string $domains
     * @return Student
     */
    public function setDomains($domains)
    {
        $this->domains = $domains;

        return $this;
    }

    /**
     * Get domains
     *
     * @return string 
     */
    public function getDomains()
    {
        return $this->domains;
    }

    /**
     * Set languages
     *
     * @param string $languages
     * @return Student
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return string 
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set user
     *
     * @param \Acatism\AuthenticationBundle\Entity\User $user
     * @return Student
     */
    public function setUser(\Acatism\AuthenticationBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Acatism\AuthenticationBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var string
     */
    protected $cvPath;

    /**
     * @var string
     */
    protected $profilePath;

    /**
     * @var UploadedFile
     */
    protected $cvFile;

    /**
     * @var UploadedFile
     */
    protected $profileFile;

    /**
    * Get profileFile.
    *
    * @return UploadedFile
    */

    public function getProfileFile()
    {
        return $this->profileFile;
    }

    /**
    * Get file.
    *
    * @return UploadedFile
    */

    /**
    * Get cvFile.
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
    * @return Student
    */

    public function setProfileFile(UploadedFile $file)
    {
        $this->profileFile = $file;

        return $this;
    }

    /**
    * Set cvFile
    *
    * @param UploadedFile $file
    * @return Student
    */
    public function setCvFile(UploadedFile $file)
    {
        $this->cvFile = $file;

        return $this;
    }


    /**
     * Set cvPath
     *
     * @param string $cvPath
     * @return Student
     */
    public function setCvPath($cvPath)
    {
        $this->cvPath = $cvPath;

        return $this;
    }

    /**
     * Get cvPath
     *
     * @return string 
     */
    public function getCvPath()
    {
        return $this->cvPath;
    }

    /**
     * Set profilePath
     *
     * @param string $profilePath
     * @return Student
     */
    public function setProfilePath($profilePath)
    {
        $this->profilePath = $profilePath;

        return $this;
    }

    /**
     * Get profilePath
     *
     * @return string 
     */
    public function getProfilePath()
    {
        return $this->profilePath;
    }
}
