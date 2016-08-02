<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupportPostReply
 *
 * @ORM\Table(name="support_post_reply")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SupportPostReplyRepository")
 */
class SupportPostReply
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=2048)
     */
    private $content;


    /* ------- SQL RELATIONSHIPS ------ */

    /**
     * @var SupportPost
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SupportPost")
     */
    private $supportPost;


    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return SupportPost
     */
    public function getSupportPost()
    {
        return $this->supportPost;
    }

    /**
     * @param SupportPost $supportPost
     */
    public function setSupportPost($supportPost)
    {
        $this->supportPost = $supportPost;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

}

