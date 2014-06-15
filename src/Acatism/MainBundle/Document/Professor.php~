<?php
// src/Acatism/MainBundle/Document/Professor.php

namespace Acatism\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Acatism\MainBundle\Form\Type\ProfessorAboutType;
use Acatism\MainBundle\Form\Type\ProfessorCvType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
* Acatism\MainBundle\Document\Professor
*
* @MongoDB\Document
*/
class Professor extends Person
{

	/**
	* @MongoDB\Field(type="string")
	*/
	protected $office;
	
    /**
    * @MongoDB\Field(type="string")
    */
    protected $teaching;

    /**
    * @MongoDB\Field(type="string")
    */
    protected $publications;

    /**
    * @MongoDB\Field(type="string")
    */
    protected $title;

    public function createAboutForm(Controller $controller)
    {
        return $controller->createForm(new ProfessorAboutType(), $this);
    }
    public function createCvForm(Controller $controller)
    {
        return $controller->createForm(new ProfessorCvType(), $this);
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
     * Set office
     *
     * @param string $office
     * @return self
     */
    public function setOffice($office)
    {
        $this->office = $office;
        return $this;
    }

    /**
     * Get office
     *
     * @return string $office
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * Set teaching
     *
     * @param string $teaching
     * @return self
     */
    public function setTeaching($teaching)
    {
        $this->teaching = $teaching;
        return $this;
    }

    /**
     * Get teaching
     *
     * @return string $teaching
     */
    public function getTeaching()
    {
        return $this->teaching;
    }

    /**
     * Set publications
     *
     * @param string $publications
     * @return self
     */
    public function setPublications($publications)
    {
        $this->publications = $publications;
        return $this;
    }

    /**
     * Get publications
     *
     * @return string $publications
     */
    public function getPublications()
    {
        return $this->publications;
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
}
