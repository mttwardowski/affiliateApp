<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrustedAffiliate
 *
 * @ORM\Table(name="trusted_affiliate")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrustedAffiliateRepository")
 */
class TrustedAffiliate
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
     * @var string
     *
     * @ORM\Column(name="dateAdded", type="string", length=255, nullable=true)
     */
    private $dateAdded;


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
     * Set dateAdded
     *
     * @param string $dateAdded
     *
     * @return TrustedAffiliate
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return string
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }
}

