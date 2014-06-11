<?php
// src/Acatism/MainBundle/Entity/Professor.php

namespace Acatism\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Acatism\MainBundle\Form\Type\ProfessorAboutType;
use Acatism\MainBundle\Form\Type\ProfessorCvType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
* Acatism\MainBundle\Entity\Professor
*
* @ORM\Entity()
*/
class Professor extends Person
{

	/**
	* @ORM\Column(type="string", length=10)
	*/
	protected $office;
	
    /**
    * @ORM\Column(type="string", length=500)
    */
    protected $teaching;

    /**
    * @ORM\Column(type="string", length=500)
    */
    protected $publications;

    /**
    * @ORM\Column(type="string", length=50)
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
     * Set office
     *
     * @param string $office
     * @return Professor
     */
    public function setOffice($office)
    {
        $this->office = $office;

        return $this;
    }

    /**
     * Get office
     *
     * @return string 
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * Set teaching
     *
     * @param string $teaching
     * @return Professor
     */
    public function setTeaching($teaching)
    {
        $this->teaching = $teaching;

        return $this;
    }

    /**
     * Get teaching
     *
     * @return string 
     */
    public function getTeaching()
    {
        return $this->teaching;
    }

    /**
     * Set publications
     *
     * @param string $publications
     * @return Professor
     */
    public function setPublications($publications)
    {
        $this->publications = $publications;

        return $this;
    }

    /**
     * Get publications
     *
     * @return string 
     */
    public function getPublications()
    {
        return $this->publications;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Professor
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set university
     *
     * @param string $university
     * @return Professor
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
     * @return Professor
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
     * @return Professor
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
     * @return Professor
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
     * @return Professor
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
     * @return Professor
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
     * @return Professor
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
     * Set cvPath
     *
     * @param string $cvPath
     * @return Professor
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
     * @return Professor
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
