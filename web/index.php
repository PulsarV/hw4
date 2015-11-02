<?php

require_once __DIR__ . '/../config/autoload.php';

use Layer\Connector\Connector;
use Layer\Manager\Manager;

$dbHandler = Connector::connect($config['host'], $config['port'], $config['db_name'], $config['db_user'], $config['db_password']);

$m1 = new Manager($dbHandler);
$m1->findAll('books');