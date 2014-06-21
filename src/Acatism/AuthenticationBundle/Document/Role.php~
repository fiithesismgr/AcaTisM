<?php

// src/Acatism/AuthenticationBundle/Document/Role.php
namespace Acatism\AuthenticationBundle\Document;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
* @MongoDB\Document(collection="roles")
*/
class Role implements RoleInterface
{
    /**
    * @MongoDB\Id(strategy="AUTO")
    */
    private $id;
    /**
    * @MongoDB\Field(type="string")
    */
    private $name;
    /**
    * @MongoDB\Field(type="string")
    */
    private $role;

    /**
    * @see RoleInterface
    */
    public function getRole()
    {
    	return $this->role;
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
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return self
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
}
