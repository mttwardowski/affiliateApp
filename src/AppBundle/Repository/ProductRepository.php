<?php

namespace AppBundle\Repository;

/**
 * ProductRepository
 * All functions needed to grab products from the database using Doctrine
 *
 * @author Matt Twardowski <mttwardowski@gmail.com>
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{

    /* COUNTING FUNCTIONS */

    /**
     * Returns the amount of products
     * @return int
     */
    public function getTotal() {
        return count($this->findAll());
    }

    /**
     * Returns the amount of active products
     * @return int
     */
    public function getTotalActive() {
        return count($this->findBy(array('status' => 1)));
    }

    /**
     * Returns the amount of inactive products
     * @return int
     */
    public function getTotalInactive() {
        return count($this->findBy(array('status' => 0)));
    }

    /* ENTITY FINDING FUNCTION */

    /**
     * Finds all active products
     * @return array
     */
    public function findAllActive() {
        return $this->findBy(array('status' => 1));
    }

    /**
     * Finds all inactive products
     * @return array
     */
    public function findAllInactive() {
        return $this->findBy(array('status' => 0));
    }

    /**
     * Finds all products for that user
     * @param $user
     * @return array
     */
    public function findAllByUser($user) {
        return $this->findBy(array('user' => $user));
    }

    /**
     * Finds all active products for that user
     * @param $user
     * @return array
     */
    public function findActiveByUser($user) {
        return $this->findBy(array('user' => $user, 'status' => 1));
    }

    /**
     * Finds all inactive products for that user
     * @param $user
     * @return array
     */
    public function findInactiveByUser($user) {
        return $this->findBy(array('user' => $user, 'status' => 0));
    }

    /**
     * Finds all the featured products
     */
    public function findFeaturedProducts() {

    }

    /**
     * Finds all the products in that category
     * @param $category
     * @return array
     */
    public function findAllByCategory($category) {
        return $this->findBy(array('category' => $category));
    }

    /**
     * Finds all the products that have that keyword
     * @param $keyword
     */
    public function findByKeyword($keyword) {

    }

    /**
     * Returns products in the order of most sales
     */
    public function findByMostSales() {

        $query = $this->createQueryBuilder("product")
            ->andWhere("product.marketplaceShow = 1")
            ->orderBy("product.sales", "DESC")
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Finds the product by the name
     * @param $name
     * @return array
     */
    public function findByName($name) {
        return $this->findBy(array('name' => $name));
    }

    /**
     * Finds the products with that price
     * @param $price
     * @return array
     */
    public function findByPrice($price) {
        return $this->findBy(array('price' => $price));
    }

    /**
     * Finds products in that price range
     * @param $start_price
     * @param $end_price
     */
    public function fundByPriceRange($start_price, $end_price) {

    }

    /**
     * Finds products in that commission range
     * @param $start_commission
     * @param $end_commission
     */
    public function findByCommisionRange($start_commission, $end_commission) {

    }

    /**
     * Finds all products with unlimited quantity
     * @return array
     */
    public function findByUnlimitedQuantity() {
        return $this->findBy(array('quantity' => 0));
    }

    /**
     * Finds products by Affiliate approval
     * @param $approval_id 0 - Manuel | 1 - Automatic
     * @return array
     */
    public function findByAffiliateApproval($approval_id) {
        return $this->findBy(array('affiliateApproval' => $approval_id));
    }







}
