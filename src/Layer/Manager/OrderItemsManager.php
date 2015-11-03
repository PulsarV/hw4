<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 03.11.15
 * Time: 1:48
 */

namespace Layer\Manager;

use Entity\OrderItem;

class OrderItemsManager extends AbstractManager
{
    /**
     * @param mixed $entity
     * @return bool|string
     */
    public function insert($entity)
    {
        try {
            $this->sth = $this->dbh->prepare("INSERT INTO order_items (orderid, isbn, quantity) values (:orderid, :isbn, :quantity)");
            $this->sth->bindParam(':orderid', $entity->getOrderId());
            $this->sth->bindParam(':isbn', $entity->getIsbn());
            $this->sth->bindParam(':quantity', $entity->getQuantity());
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
            $this->sth = $this->dbh->prepare("UPDATE order_items SET isbn = :isbn, quantity = :quantity WHERE orderid = :orderid");
            $this->sth->bindParam(':orderid', $entity->getOrderId());
            $this->sth->bindParam(':isbn', $entity->getIsbn());
            $this->sth->bindParam(':quantity', $entity->getQuantity());
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
            $this->sth = $this->dbh->prepare("DELETE FROM order_items WHERE orderid = :orderid");
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
            $this->sth = $this->dbh->prepare("SELECT * FROM order_items WHERE orderid = :orderid");
            $this->sth->bindParam(':orderid', $id);
            $this->sth->execute();
            $this->sth->setFetchMode(\PDO::FETCH_ASSOC);
            $resultArray = [];
            while ($row = $this->sth->fetch()) {
                $resultArray[] = new OrderItem($row['orderid'], $row['isbn'], $row['quantity']);
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
            $this->sth = $this->dbh->prepare("SELECT * FROM order_items");
            $this->sth->execute();
            $this->sth->setFetchMode(\PDO::FETCH_ASSOC);
            $resultArray = [];
            while ($row = $this->sth->fetch()) {
                $resultArray[] = new OrderItem($row['orderid'], $row['isbn'], $row['quantity']);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $resultArray;
    }
}