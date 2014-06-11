<?php
// src/Acatism/MainBundle/Entity/Person.php
namespace Acatism\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"person" = "Person", "professor" = "Professor", "student" = "Student"})
 */


abstract class Person
{
	/**
    * @ORM\Id
    * @ORM\OneToOne(targetEntity="Acatism\AuthenticationBundle\Entity\User")
    */
    protected $user;

	/**
	* @ORM\Column(type="string", length=100)
	*/
	protected $university;

	/**
	* @ORM\Column(type="string", length=100)
	*/
	protected $faculty;

	/**
	* @ORM\Column(type="string", length=15)
	*/
	protected $phone;

    /**
    * @ORM\Column(type="string", length=100)
    */
    protected $website;


	/**
	* @ORM\Column(type="string", length=500)
	*/
	protected $domains;

	/**
    * @ORM\Column(type="string", length=100)
    */
    protected $languages;

    /**
	* @ORM\Column(type="string", length=255, nullable=true)
	*/
	protected $cvPath;

	/**
	* @Assert\File(maxSize="6000000")
	*/
	protected $cvFile;


	/**
	* @ORM\Column(type="string", length=255, nullable=true)
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
     * Set university
     *
     * @param string $university
     * @return Person
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
     * @return Person
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
     * @return Person
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
     * @return Person
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
     * @return Person
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
     * @return Person
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
     * @return Person
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
     * Set cvPath
     *
     * @param string $cvPath
     * @return Person
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
     * @return Person
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
