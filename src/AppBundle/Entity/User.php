<?php

namespace AppBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name = "First Last";

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $mailing_address = "No Mailing Address";

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $phone = "000-000-0000";

    /**
     * @var double
     *
     * @ORM\Column(type="float")
     */
    private $earnings = 0;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $sales = 0;



    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMailingAddress()
    {
        return $this->mailing_address;
    }

    /**
     * @param string $mailing_address
     */
    public function setMailingAddress($mailing_address)
    {
        $this->mailing_address = $mailing_address;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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

    /* ----- HELPER FUNCTIONS ----- */

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