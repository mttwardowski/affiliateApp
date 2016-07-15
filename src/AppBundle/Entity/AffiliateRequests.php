<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AffiliateRequests
 *
 * @ORM\Table(name="affiliate_requests")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AffiliateRequestsRepository")
 */
class AffiliateRequests
{

    //Static Variables
    public static $REQUEST_PENDING = 0;
    public static $REQUEST_ACCEPTED = 1;
    public static $REQUEST_DENIED = 2;

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
     * @ORM\Column(name="message", type="string", length=1024)
     */
    private $message;

    /**
     * @var int
     *
     * 0 - Pending
     * 1 - Approved
     * 2 - Denied
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="sales", type="integer")
     */
    private $sales;

    /**
     * @var float
     *
     * @ORM\Column(name="earnings", type="float")
     */
    private $earnings;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="affiliateRequests")
     */
    private $product;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;


    /**
     * @param User $user
     * @param Product $product
     */
    public function __construct(User $user, Product $product) {
        $this->createdAt = new \DateTime();
        $this->status = AffiliateRequests::$REQUEST_PENDING;
        $this->sales = 0;
        $this->earnings = 0;
        $this->user = $user;
        $this->product = $product;
    }


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
     * @return AffiliateRequests
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
     * Set message
     *
     * @param string $message
     *
     * @return AffiliateRequests
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return AffiliateRequests
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set sales
     *
     * @param integer $sales
     *
     * @return AffiliateRequests
     */
    public function setSales($sales)
    {
        $this->sales = $sales;

        return $this;
    }

    /**
     * Get sales
     *
     * @return int
     */
    public function getSales()
    {
        return $this->sales;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
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
     * @return float
     */
    public function getEarnings()
    {
        return $this->earnings;
    }

    /**
     * @param float $earnings
     */
    public function setEarnings($earnings)
    {
        $this->earnings = $earnings;
    }

    /* ------ HELPER FUNCTIONS ------ */

    /**
     * Increments the sales by 1
     */
    public function incrementSales() {
        $this->sales = ($this->getSales() + 1);
    }

    /**
     * Increments the earnings by the value
     *
     * @param $value
     */
    public function incrementEarnings($value) {
        $this->earnings = ($this->earnings + $value);
    }



}

