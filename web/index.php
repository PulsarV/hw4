<?php

require __DIR__ . '/../config/autoload.php';

use Layer\Connector\Connector;

$d1 = new Connector();

$d1->connect($config['host'], $config['port'], $config['db_name'], $config['db_user'], $config['db_password']);