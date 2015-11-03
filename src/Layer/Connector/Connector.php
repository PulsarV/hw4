<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr Kravchuk
 * Date: 01.11.15
 * Time: 21:18
 */

namespace Layer\Connector;

use PDO;

class Connector implements ConnectorInterface
{
    private static $dbh = null;

    /**
     * @param $host
     * @param $port
     * @param $dbname
     * @param $user
     * @param $password
     * @return null|PDO
     */
    public static function connect($host, $port, $dbname, $user, $password)
    {
        if (is_null(self::$dbh)) {
            try {
                self::$dbh = new \PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbname . ';charset=UTF8', $user, $password);
                self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$dbh;
    }

    /**
     * @param $db
     */
    public static function connectClose($db)
    {
        $db = null;
    }

    /**
     *
     */
    public function __destruct()
    {
        self::connectClose(self::$dbh);
    }
}