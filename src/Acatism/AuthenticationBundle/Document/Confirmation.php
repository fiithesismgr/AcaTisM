<?php

// src/Acatism/AuthenticationBundle/Document/Application.php

namespace Acatism\AuthenticationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;



/**
 * Acatism\AuthenticationBundle\Document\Confirmation
 * @MongoDB\Document
 */
class Confirmation
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
    protected $confirmationHash;

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
     * Set confirmationHash
     *
     * @param string $confirmationHash
     * @return self
     */
    public function setConfirmationHash($confirmationHash)
    {
        $this->confirmationHash = $confirmationHash;
        return $this;
    }

    /**
     * Get confirmationHash
     *
     * @return string $confirmationHash
     */
    public function getConfirmationHash()
    {
        return $this->confirmationHash;
    }
}
