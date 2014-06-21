<?php

// src/Acatism/AuthenticationBundle/Document/User.php
namespace Acatism\AuthenticationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @MongoDB\Document(collection="users", repositoryClass="Acatism\AuthenticationBundle\Repository\UserRepository")
 */

class User implements AdvancedUserInterface, \Serializable
{
	/**
	* @MongoDB\Id(strategy="AUTO")
	*/
	private $id;

	/**
	* @MongoDB\Field(type="string")
	*/
	private $firstname;

	/**
	* @MongoDB\Field(type="string")
	*/
	private $lastname;

	/**
	* @MongoDB\Field(type="string")
	*/
	private $username;

	/**
	* @MongoDB\Field(type="string")
	*/
	private $password;

	/**
	* @MongoDB\Field(type="string")
	*/
	private $email;

	/**
     * @MongoDB\ReferenceOne(targetDocument="Role")
     **/
	private $role;

	/**
	* @MongoDB\Field(type="boolean")
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
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string $lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return self
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
     * @return self
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
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set role
     *
     * @param Acatism\AuthenticationBundle\Document\Role $role
     * @return self
     */
    public function setRole(\Acatism\AuthenticationBundle\Document\Role $role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get role
     *
     * @return Acatism\AuthenticationBundle\Document\Role $role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean $isActive
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
