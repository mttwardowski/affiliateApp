<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Autoresponder
 *
 * @ORM\Table(name="autoresponder")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AutoresponderRepository")
 */
class Autoresponder
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="api_id", type="integer")
     */
    private $apiId;

    /**
     * @var string
     *
     * @ORM\Column(name="sendlane_api_key", type="string", length=255)
     */
    private $sendlaneApiKey;

    /**
     * @var string
     *
     * @ORM\Column(name="sendlane_api_username", type="string", length=255)
     */
    private $sendlaneApiUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="sendlane_api_hash", type="string", length=255)
     */
    private $sendlaneApiHash;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Autoresponder
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Autoresponder
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set apiId
     *
     * @param integer $apiId
     *
     * @return Autoresponder
     */
    public function setApiId($apiId)
    {
        $this->apiId = $apiId;

        return $this;
    }

    /**
     * Get apiId
     *
     * @return int
     */
    public function getApiId()
    {
        return $this->apiId;
    }

    /**
     * Set sendlaneApiKey
     *
     * @param string $sendlaneApiKey
     *
     * @return Autoresponder
     */
    public function setSendlaneApiKey($sendlaneApiKey)
    {
        $this->sendlaneApiKey = $sendlaneApiKey;

        return $this;
    }

    /**
     * Get sendlaneApiKey
     *
     * @return string
     */
    public function getSendlaneApiKey()
    {
        return $this->sendlaneApiKey;
    }

    /**
     * Set sendlaneApiUsername
     *
     * @param string $sendlaneApiUsername
     *
     * @return Autoresponder
     */
    public function setSendlaneApiUsername($sendlaneApiUsername)
    {
        $this->sendlaneApiUsername = $sendlaneApiUsername;

        return $this;
    }

    /**
     * Get sendlaneApiUsername
     *
     * @return string
     */
    public function getSendlaneApiUsername()
    {
        return $this->sendlaneApiUsername;
    }

    /**
     * Set sendlaneApiHash
     *
     * @param string $sendlaneApiHash
     *
     * @return Autoresponder
     */
    public function setSendlaneApiHash($sendlaneApiHash)
    {
        $this->sendlaneApiHash = $sendlaneApiHash;

        return $this;
    }

    /**
     * Get sendlaneApiHash
     *
     * @return string
     */
    public function getSendlaneApiHash()
    {
        return $this->sendlaneApiHash;
    }
}

