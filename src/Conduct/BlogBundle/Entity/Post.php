<?php

namespace Conduct\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 */
class Post
{

    const STATUS_OPEN = 1;

    const STATUS_CLOSED = 0;
    /**
     * @var integer
     */
    private $id;



    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $postDate;

    private $postStatus;

    /**
     * @var string
     */
    private $postExcerpt;

    private $postModified;

    private $postAuthor;



    protected $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Post
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
     *
     * @Assert\NotBlank()
     */
    public function getTitle()
    {
        return $this->title;
    }



    /**
     * Set postDate
     *
     * @param \DateTime $postDate
     * @return Post
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return \DateTime 
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $postExcerpt
     */
    public function setPostExcerpt($postExcerpt)
    {
        $this->postExcerpt = $postExcerpt;
    }

    /**
     * @return mixed
     */
    public function getPostExcerpt()
    {
        return $this->postExcerpt;
    }

    /**
     * @param mixed $postModified
     */
    public function setPostModified($postModified)
    {
        $this->postModified = $postModified;
    }

    /**
     * @return mixed
     */
    public function getPostModified()
    {
        return $this->postModified;
    }

    /**
     * @param mixed $postStatus
     */
    public function setPostStatus($postStatus)
    {
        $this->postStatus = $postStatus;
    }

    /**
     * @return mixed
     */
    public function getPostStatus()
    {
        return $this->postStatus;
    }

    /**
     * @param mixed $postAuthor
     */
    public function setPostAuthor($postAuthor)
    {
        $this->postAuthor = $postAuthor;
    }

    /**
     * @return mixed
     */
    public function getPostAuthor()
    {
        return $this->postAuthor;
    }


}
