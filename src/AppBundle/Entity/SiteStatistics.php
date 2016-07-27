<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SiteStatistics
 *
 * @ORM\Table(name="site_statistics")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SiteStatisticsRepository")
 */
class SiteStatistics
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
     * @var int
     *
     * @ORM\Column(name="numProducts", type="integer")
     */
    private $numProducts;

    /**
     * @var int
     *
     * @ORM\Column(name="numUsers", type="integer")
     */
    private $numUsers;

    /**
     * @var int
     *
     * @ORM\Column(name="numSales", type="integer")
     */
    private $numSales;


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
     * @return SiteStatistics
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
     * Set numProducts
     *
     * @param integer $numProducts
     *
     * @return SiteStatistics
     */
    public function setNumProducts($numProducts)
    {
        $this->numProducts = $numProducts;

        return $this;
    }

    /**
     * Get numProducts
     *
     * @return int
     */
    public function getNumProducts()
    {
        return $this->numProducts;
    }

    /**
     * Set numUsers
     *
     * @param integer $numUsers
     *
     * @return SiteStatistics
     */
    public function setNumUsers($numUsers)
    {
        $this->numUsers = $numUsers;

        return $this;
    }

    /**
     * Get numUsers
     *
     * @return int
     */
    public function getNumUsers()
    {
        return $this->numUsers;
    }

    /**
     * Set numSales
     *
     * @param integer $numSales
     *
     * @return SiteStatistics
     */
    public function setNumSales($numSales)
    {
        $this->numSales = $numSales;

        return $this;
    }

    /**
     * Get numSales
     *
     * @return int
     */
    public function getNumSales()
    {
        return $this->numSales;
    }
}

