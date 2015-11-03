<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 03.11.15
 * Time: 1:43
 */

namespace Layer\Manager;

use Entity\Customer;

class CustomersManager extends AbstractManager
{
    public function insert($entity)
    {
        try {
            $this->sth = $this->dbh->prepare("INSERT INTO customers (name, address, city) values (:name, :address, :city)");
            $this->sth->bindParam(':name', $entity->getName());
            $this->sth->bindParam(':address', $entity->getAddress());
            $this->sth->bindParam(':city', $entity->getCity());
            $this->sth->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $this->dbh->lastInsertId();
    }

    public function update($entity)
    {
        try {
            $this->sth = $this->dbh->prepare("UPDATE customers SET name = :name, address = :address, city = :city WHERE customerid = :customerid");
            $this->sth->bindParam(':customerid', $entity->getCustomerId());
            $this->sth->bindParam(':name', $entity->getName());
            $this->sth->bindParam(':address', $entity->getAddress());
            $this->sth->bindParam(':city', $entity->getCity());
            $this->sth->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function remove($entity)
    {
        try {
            $this->sth = $this->dbh->prepare("DELETE FROM customers WHERE customerid = :customerid");
            $this->sth->bindParam(':customerid', $entity->getCustomerId());
            $this->sth->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function find($id)
    {
        try {
            $this->sth = $this->dbh->prepare("SELECT * FROM customers WHERE customerid = :customerid");
            $this->sth->bindParam(':customerid', $id);
            $this->sth->execute();
            $this->sth->setFetchMode(\PDO::FETCH_ASSOC);
            $resultArray = [];
            while ($row = $this->sth->fetch()) {
                $resultArray[] = new Customer($row['customerid'], $row['name'], $row['address'], $row['city']);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $resultArray;
    }

    public function findAll()
    {
        try {
            $this->sth = $this->dbh->prepare("SELECT * FROM customers");
            $this->sth->execute();
            $this->sth->setFetchMode(\PDO::FETCH_ASSOC);
            $resultArray = [];
            while ($row = $this->sth->fetch()) {
                $resultArray[] = new Customer($row['customerid'], $row['name'], $row['address'], $row['city']);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $resultArray;
    }
}