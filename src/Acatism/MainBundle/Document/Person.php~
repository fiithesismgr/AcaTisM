<?php
// src/Acatism/MainBundle/Document/Person.php
namespace Acatism\MainBundle\Document;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 * @MongoDB\InheritanceType("SINGLE_COLLECTION")
 * @MongoDB\DiscriminatorField("type")
 * @MongoDB\DiscriminatorMap({"person"="Person", "student"="Student", "professor"="Professor"})
 */
abstract class Person
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
	protected $university;

	/**
	* @MongoDB\Field(type="string")
	*/
	protected $faculty;

	/**
	* @MongoDB\Field(type="string")
	*/
	protected $phone;

    /**
    * @MongoDB\Field(type="string")
    */
    protected $website;


	/**
	* @MongoDB\Field(type="string")
	*/
	protected $domains;

	/**
    * @MongoDB\Field(type="string")
    */
    protected $languages;

    /**
	* @MongoDB\Field(type="string")
	*/
	protected $cvPath;

	/**
	* @Assert\File(maxSize="6000000")
	*/
	protected $cvFile;


	/**
	* @MongoDB\Field(type="string")
	*/
	protected $profilePath;

	/**
	* @Assert\File(maxSize="6000000")
	*/
	protected $profileFile;


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

	public function upload()
	{
		if(!is_null($this->profileFile))
		{
			$extension = $this->profileFile->guessExtension();
			$directory = __DIR__.'/../../../../web/'.'images/students';
			$path = $this->user->getUsername(). '.' . $extension;
			$this->profileFile->move($directory, $path);
			$this->profilePath = 'images/students/' . $path;
		}
		else
		{
			$this->profilePath = 'images/students/default_profile.jpg';
		}

		if(!is_null($this->cvFile))
		{
			$extension = $this->cvFile->guessExtension();
			$directory = __DIR__.'/../../../../web/'.'files/cvs';
			$path = $this->user->getUsername(). '.' . $extension;
			$this->cvFile->move($directory, $path);
			$this->cvPath = 'files/cvs/' . $path;
		}
		

		$this->profileFile = null;
		$this->cvFile = null;
	}

    abstract public function createAboutForm(Controller $controller);
    abstract public function createCvForm(Controller $controller);

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
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }
}
