<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderDetails
 *
 * @ORM\Table(name="order_details")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderDetailsRepository")
 */
class OrderDetails
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
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="Orders", inversedBy="orderProducts")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", onDelete="CASCADE")
     **/
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productOrders")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     **/
    private $product;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


    public function __toString()
    {
        /**
         * @var Product $product
         */
        //return $this->product->getTitle();\
        return "product";
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
     * Set order
     *
     * @param Orders $order;
     * @return OrderDetails
     */
    public function setOrder(Orders $order = null)
    {
        $this->order = $order;
        return $this;
    }
    /**
     * Get order
     *
     * @return Orders
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product
     *
     * @param Product $product
     * @return OrderDetails
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;

        return $this;
    }
    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return OrderDetails
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
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return OrderDetails
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}

