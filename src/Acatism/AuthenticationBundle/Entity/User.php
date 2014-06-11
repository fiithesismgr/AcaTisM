<?php

// src/Acatism/AuthenticationBundle/Entity/User.php
namespace Acatism\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
* Acatism\AuthenticationBundle\Entity\User
*
* @ORM\Table(name="users")
* @ORM\Entity(repositoryClass="Acatism\AuthenticationBundle\Entity\UserRepository")
*/

class User implements AdvancedUserInterface, \Serializable
{
	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	private $id;

	/**
	* @ORM\Column(type="string", length=25)
	*/
	private $firstname;

	/**
	* @ORM\Column(type="string", length=25)
	*/
	private $lastname;

	/**
	* @ORM\Column(type="string", length=25, unique=true)
	*/
	private $username;

	/**
	* @ORM\Column(type="string", length=64)
	*/
	private $password;

	/**
	* @ORM\Column(type="string", length=60, unique=true)
	*/
	private $email;

	/**
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     **/
	private $role;

	/**
	* @ORM\Column(name="is_active", type="boolean")
	*/
	private $isActive;

	public function __construct()
	{
		$this->isActive = true;
		// $this->role = new Role();
		// may not be needed, see section on salt below
		// $this->salt = md5(uniqid(null, true));
	}

	/**
	* @inheritDoc
	*/
	public function getUsername()
	{
		return $this->username;
	}

	/**
	* @inheritDoc
	*/
	public function getSalt()
	{
	    // you *may* need a real salt depending on your encoder
	    // see section on salt below
		return null;
	}
	/**
	* @inheritDoc
	*/
	public function getPassword()
	{
		return $this->password;
	}

	/**
	* @inheritDoc
	*/
	public function getRoles()
	{
		return array($this->role);
	}

	/**
	* @inheritDoc
	*/
	public function eraseCredentials()
	{

	}
	/**
	* @see \Serializable::serialize()
	*/
	public function serialize()
	{
		return serialize(array(
			$this->id,
			$this->username,
			$this->password,
			// see section on salt below
			// $this->salt,
		));
	}
	/**
	* @see \Serializable::unserialize()
	*/
	public function unserialize($serialized)
	{
		list (
			$this->id,
			$this->username,
			$this->password,
			// see section on salt below
			// $this->salt,
		) = unserialize($serialized);
	}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function isAccountNonExpired()
    {
    	return true;
    }
    public function isAccountNonLocked()
    {
    	return true;
    }
    public function isCredentialsNonExpired()
    {
    	return true;
    }
    public function isEnabled()
    {
    	return $this->isActive;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set role
     *
     * @param \Acatism\AuthenticationBundle\Entity\Role $role
     * @return User
     */
    public function setRole(\Acatism\AuthenticationBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Acatism\AuthenticationBundle\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }
}
