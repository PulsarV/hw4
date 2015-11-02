<?php

/**
 * Class AbstractManager
 * @package Layer\Manager
 */

namespace Layer\Manager;

abstract class AbstractManager implements ManagerInterface
{
    protected $dbh;
    protected $sth;

    public function __construct(\PDO $dbHandler)
    {
        $this->dbh = $dbHandler;
    }

    public function insert($entity)
    {

    }

    public function update($entity)
    {

    }

    public function remove($entity)
    {

    }

    public function find($entityName, $id)
    {
        /*echo 'safasfasfasfasdf';
        $this->st = $this->db->query('SELECT * FROM test');
        foreach ($st->fetchAll() as $row) {
            print "{$row['symbol']} goes with {$row['planet']} <br/>\n";
        }*/
    }

    public function findAll($entityName)
    {
        try {
            $this->sth = $this->dbh->prepare("SELECT * FROM " . $entityName);
            $this->sth->execute();
            $this->sth->setFetchMode(\PDO::FETCH_BOTH);
            while ($row = $this->sth->fetch()) {
                echo $row[0] . '<br>';
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findBy($entityName, $criteria = [])
    {

    }

}
