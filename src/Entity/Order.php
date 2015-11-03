<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 03.11.15
 * Time: 0:59
 */

namespace Entity;

class Order
{
    protected $orderId;
    protected $customerId;
    protected $Amount;

    /**
     * Order constructor.
     * @param $orderId
     * @param $customerId
     * @param $Amount
     * @param $Date
     */
    public function __construct($orderId, $customerId, $Amount)
    {
        $this->orderId = $orderId;
        $this->customerId = $customerId;
        $this->Amount = $Amount;
    }


    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param mixed $Amount
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
    }
}