<?php
// src/Acatism/MainBundle/Document/SocialMedia.php

namespace Acatism\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * Acatism\MainBundle\Document\Professor
 *
 * @MongoDB\Document
 */
class SocialMedia
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
    protected $facebook;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $googleplus;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $twitter;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $skype;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $dropbox;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $github;


    /**
     * Set facebook
     *
     * @param string $facebook
     * @return self
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
        return $this;
    }

    /**
     * Get facebook
     *
     * @return string $facebook
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set googleplus
     *
     * @param string $googleplus
     * @return self
     */
    public function setGoogleplus($googleplus)
    {
        $this->googleplus = $googleplus;
        return $this;
    }

    /**
     * Get googleplus
     *
     * @return string $googleplus
     */
    public function getGoogleplus()
    {
        return $this->googleplus;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return self
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
        return $this;
    }

    /**
     * Get twitter
     *
     * @return string $twitter
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set skype
     *
     * @param string $skype
     * @return self
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;
        return $this;
    }

    /**
     * Get skype
     *
     * @return string $skype
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set dropbox
     *
     * @param string $dropbox
     * @return self
     */
    public function setDropbox($dropbox)
    {
        $this->dropbox = $dropbox;
        return $this;
    }

    /**
     * Get dropbox
     *
     * @return string $dropbox
     */
    public function getDropbox()
    {
        return $this->dropbox;
    }

    /**
     * Set github
     *
     * @param string $github
     * @return self
     */
    public function setGithub($github)
    {
        $this->github = $github;
        return $this;
    }

    /**
     * Get github
     *
     * @return string $github
     */
    public function getGithub()
    {
        return $this->github;
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
}
