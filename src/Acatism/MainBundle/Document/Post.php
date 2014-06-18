<?php

// src/Acatism/MainBundle/Document/Post.php

namespace Acatism\MainBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Acatism\MainBundle\Document\Post
 * @MongoDB\Document
 */

class Post
{

    /**
     * @MongoDB\Id(strategy="AUTO")
     */

    protected $id;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max = 500)
     */

    protected $title;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */

    protected $content;


    /**
     * @MongoDB\ReferenceOne(targetDocument="Acatism\AuthenticationBundle\Document\User")
     */

    protected $professor;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $date;



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
     * Set content
     *
     * @param string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set professor
     *
     * @param Acatism\AuthenticationBundle\Document\User $professor
     * @return self
     */
    public function setProfessor(\Acatism\AuthenticationBundle\Document\User $professor)
    {
        $this->professor = $professor;
        return $this;
    }

    /**
     * Get professor
     *
     * @return Acatism\AuthenticationBundle\Document\User $professor
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * Set date
     *
     * @param date $date
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return date $date
     */
    public function getDate()
    {
        return $this->date;
    }
}
