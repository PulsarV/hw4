<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 03.11.15
 * Time: 1:45
 */

namespace Layer\Manager;

use Entity\Order;

class OrdersManager extends AbstractManager
{
    /**
     * @param mixed $entity
     * @return bool|string
     */
    public function insert($entity)
    {
        try {
            $this->sth = $this->dbh->prepare("INSERT INTO orders (customerid, amount) values (:customerid, :amount)");
            $this->sth->bindParam(':customerid', $entity->getCustomerId());
            $this->sth->bindParam(':amount', $entity->getAmount());
            $this->sth->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $this->dbh->lastInsertId();
    }

    /**
     * @param $entity
     * @return bool
     */
    public function update($entity)
    {
        try {
            $this->sth = $this->dbh->prepare("UPDATE orders SET customerid = :customerid, amount = :amount WHERE orderid = :orderid");
            $this->sth->bindParam(':orderid', $entity->getOrderId());
            $this->sth->bindParam(':customerid', $entity->getCustomerId());
            $this->sth->bindParam(':amount', $entity->getAmount());
            $this->sth->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @param $entity
     * @return bool
     */
    public function remove($entity)
    {
        try {
            $this->sth = $this->dbh->prepare("DELETE FROM orders WHERE orderid = :orderid");
            $this->sth->bindParam(':orderid', $entity->getOrderId());
            $this->sth->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function find($id)
    {
        try {
            $this->sth = $this->dbh->prepare("SELECT * FROM orders WHERE orderid = :orderid");
            $this->sth->bindParam(':orderid', $id);
            $this->sth->execute();
            $this->sth->setFetchMode(\PDO::FETCH_ASSOC);
            $resultArray = [];
            while ($row = $this->sth->fetch()) {
                $resultArray[] = new Order($row['orderid'], $row['customerid'], $row['amount']);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $resultArray;
    }

    /**
     * @return array|bool
     */
    public function findAll()
    {
        try {
            $this->sth = $this->dbh->prepare("SELECT * FROM orders");
            $this->sth->execute();
            $this->sth->setFetchMode(\PDO::FETCH_ASSOC);
            $resultArray = [];
            while ($row = $this->sth->fetch()) {
                $resultArray[] = new Order($row['orderid'], $row['customerid'], $row['amount']);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $resultArray;
    }
}