<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="commission", type="float")
     */
    private $commission;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="allow_sales", type="integer")
     */
    private $allowSales;

    /**
     * @var int
     *
     * 0 - Do not Show in Marketplace
     * 1 - Show in Marketplace
     *
     * @ORM\Column(name="marketplaceShow", type="integer")
     */
    private $marketplaceShow;

    /**
     * @var int
     *
     * @ORM\Column(name="currency", type="integer")
     */
    private $currency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="launchDate", type="datetime", nullable=true)
     */
    private $launchDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="supportEmail", type="string", length=255, nullable=true)
     */
    private $supportEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="supportURL", type="string", length=255, nullable=true)
     */
    private $supportURL;

    /**
     * @var string
     *
     * @ORM\Column(name="pageURL", type="string", length=1024)
     */
    private $pageURL;

    /**
     * @var int
     *
     * @ORM\Column(name="return_period_number", type="integer", nullable=true)
     */
    private $returnPeriodNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="return_period_unit", type="integer", nullable=true)
     */
    private $returnPeriodUnit;

    /**
     * @var int
     *
     * 0 - Manual
     * 1- Automatic
     *
     * @ORM\Column(name="affiliateApproval", type="integer")
     */
    private $affiliateApproval;

    /**
     * @var int
     *
     * 0 - inactive
     * 1 - active
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
     * @var int
     *
     * @ORM\Column(name="num_affiliates", type="integer")
     */
    private $numberAffiliates;


    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;


    /**
     * @var AffiliateRequests
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AffiliateRequests", mappedBy="product")
     */
    private $affiliateRequests;



    /* ------- MARKETPLACE OPTIONS ------- */

    /**
     * @var String
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var String
     *
     * @ORM\Column(name="keywords", type="string", length=255, nullable=true)
     */
    private $keywords;

    /**
     * @var Categories
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categories")
     */
    private $category;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->affiliateRequests = new ArrayCollection();
        $this->sales = 0;
        $this->returnPeriodNumber = 0;
        $this->returnPeriodUnit = 0;
        $this->affiliateApproval = 0;
        $this->status = 1;
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
     * @return Product
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
     * @return Product
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
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set commission
     *
     * @param float $commission
     *
     * @return Product
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * Get commission
     *
     * @return float
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set allowSales
     *
     * @param integer $allowSales
     *
     * @return Product
     */
    public function setAllowSales($allowSales)
    {
        $this->allowSales = $allowSales;

        return $this;
    }

    /**
     * Get allowSales
     *
     * @return int
     */
    public function getAllowSales()
    {
        return $this->allowSales;
    }

    /**
     * Set marketplaceShow
     *
     * @param integer $marketplaceShow
     *
     * @return Product
     */
    public function setMarketplaceShow($marketplaceShow)
    {
        $this->marketplaceShow = $marketplaceShow;

        return $this;
    }

    /**
     * Get marketplaceShow
     *
     * @return int
     */
    public function getMarketplaceShow()
    {
        return $this->marketplaceShow;
    }

    /**
     * Set currency
     *
     * @param integer $currency
     *
     * @return Product
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return int
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set launchDate
     *
     * @param \DateTime $launchDate
     *
     * @return Product
     */
    public function setLaunchDate($launchDate)
    {
        $this->launchDate = $launchDate;

        return $this;
    }

    /**
     * Get launchDate
     *
     * @return \DateTime
     */
    public function getLaunchDate()
    {
        return $this->launchDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Product
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set supportEmail
     *
     * @param string $supportEmail
     *
     * @return Product
     */
    public function setSupportEmail($supportEmail)
    {
        $this->supportEmail = $supportEmail;

        return $this;
    }

    /**
     * Get supportEmail
     *
     * @return string
     */
    public function getSupportEmail()
    {
        return $this->supportEmail;
    }

    /**
     * Set pageURL
     *
     * @param string $pageURL
     *
     * @return Product
     */
    public function setPageURL($pageURL)
    {
        $this->pageURL = $pageURL;

        return $this;
    }

    /**
     * Get pageURL
     *
     * @return string
     */
    public function getPageURL()
    {
        return $this->pageURL;
    }

    /**
     * Set affiliateApproval
     *
     * @param integer $affiliateApproval
     *
     * @return Product
     */
    public function setAffiliateApproval($affiliateApproval)
    {
        $this->affiliateApproval = $affiliateApproval;

        return $this;
    }

    /**
     * Get affiliateApproval
     *
     * @return int
     */
    public function getAffiliateApproval()
    {
        return $this->affiliateApproval;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Product
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
    public function getSupportURL()
    {
        return $this->supportURL;
    }

    /**
     * @param string $supportURL
     */
    public function setSupportURL($supportURL)
    {
        $this->supportURL = $supportURL;
    }

    /**
     * @return int
     */
    public function getReturnPeriodNumber()
    {
        return $this->returnPeriodNumber;
    }

    /**
     * @param int $returnPeriodNumber
     */
    public function setReturnPeriodNumber($returnPeriodNumber)
    {
        $this->returnPeriodNumber = $returnPeriodNumber;
    }

    /**
     * @return int
     */
    public function getReturnPeriodUnit()
    {
        return $this->returnPeriodUnit;
    }

    /**
     * @param int $returnPeriodUnit
     */
    public function setReturnPeriodUnit($returnPeriodUnit)
    {
        $this->returnPeriodUnit = $returnPeriodUnit;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return String
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param String $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return Categories
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Categories $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getSales()
    {
        return $this->sales;
    }

    /**
     * @param int $sales
     */
    public function setSales($sales)
    {
        $this->sales = $sales;
    }

    /**
     * @return AffiliateRequests
     */
    public function getAffiliateRequests()
    {
        return $this->affiliateRequests;
    }

    /**
     * @return int
     */
    public function getNumberAffiliates()
    {
        return $this->numberAffiliates;
    }

    /**
     * @param int $numberAffiliates
     */
    public function setNumberAffiliates($numberAffiliates)
    {
        $this->numberAffiliates = $numberAffiliates;
    }

    /* ----- HELPER FUNCTIONS ----- */

    /**
     * Increments the sales by 1
     */
    public function incrementSales() {
        $this->sales = ($this->getSales() + 1);
    }

    /**
     * Increments the number of affiliates by 1
     */
    public function incrementNumberAffiliates() {
        $this->numberAffiliates = ($this->getNumberAffiliates() + 1);
    }





}

