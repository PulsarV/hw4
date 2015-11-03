<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 01.11.15
 * Time: 23:05
 */

namespace Layer\Manager;
use Entity\Book;

class BooksManager extends AbstractManager
{
    /**
     * @param mixed $entity
     * @return bool|string
     */
    public function insert($entity)
    {
        try {
            $this->sth = $this->dbh->prepare("INSERT INTO books (isbn, author, title, price) values (:isbn, :author, :title, :price)");
            $this->sth->bindParam(':isbn', $entity->getIsbn());
            $this->sth->bindParam(':author', $entity->getAuthor());
            $this->sth->bindParam(':title', $entity->getTitle());
            $this->sth->bindParam(':price', $entity->getPrice());
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
            $this->sth = $this->dbh->prepare("UPDATE books SET author = :author, title = :title, price = :price WHERE isbn = :isbn");
            $this->sth->bindParam(':isbn', $entity->getIsbn());
            $this->sth->bindParam(':author', $entity->getAuthor());
            $this->sth->bindParam(':title', $entity->getTitle());
            $this->sth->bindParam(':price', $entity->getPrice());
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
            $this->sth = $this->dbh->prepare("DELETE FROM books WHERE isbn = :isbn");
            $this->sth->bindParam(':isbn', $entity->getIsbn());
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
            $this->sth = $this->dbh->prepare("SELECT * FROM books WHERE isbn = :isbn");
            $this->sth->bindParam(':isbn', $id);
            $this->sth->execute();
            $this->sth->setFetchMode(\PDO::FETCH_ASSOC);
            $resultArray = [];
            while ($row = $this->sth->fetch()) {
                $resultArray[] = new Book($row['isbn'], $row['author'], $row['title'], $row['price']);
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
            $this->sth = $this->dbh->prepare("SELECT * FROM books");
            $this->sth->execute();
            $this->sth->setFetchMode(\PDO::FETCH_ASSOC);
            $resultArray = [];
            while ($row = $this->sth->fetch()) {
                $resultArray[] = new Book($row['isbn'], $row['author'], $row['title'], $row['price']);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $resultArray;
    }
}