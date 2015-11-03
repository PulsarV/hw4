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
}
