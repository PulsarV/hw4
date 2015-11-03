<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 03.11.15
 * Time: 0:55
 */

namespace Entity;

class Customer
{
    protected $customerId;
    protected $name;
    protected $address;
    protected $city;

    /**
     * Customer constructor.
     * @param $customerId
     * @param $name
     * @param $address
     * @param $city
     */
    public function __construct($customerId, $name, $address, $city)
    {
        $this->customerId = $customerId;
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
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
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }
}