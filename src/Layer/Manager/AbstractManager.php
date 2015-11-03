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

    /**
     * @param \PDO $dbHandler
     */
    public function __construct(\PDO $dbHandler)
    {
        $this->dbh = $dbHandler;
    }
}
