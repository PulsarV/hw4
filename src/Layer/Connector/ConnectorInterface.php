<?php

namespace Layer\Connector;

/**
 * Interface ConnectorInterface
 * @package Layer\Connector
 */
interface ConnectorInterface
{
    /**
     * @param $host
     * @param $port
     * @param $dbname
     * @param $user
     * @param $password
     * @return mixed
     */
    public static function connect($host, $port, $dbname, $user, $password);

    /**
     * @param $db
     * @return mixed
     */
    public static function connectClose($db);
}