<?php

require_once __DIR__ . '/../config/autoload.php';

use Layer\Connector\Connector;
use Layer\Manager\BooksManager;
use Layer\Manager\CustomersManager;
use Layer\Manager\OrdersManager;
use Layer\Manager\OrderItemsManager;
use Entity\Book;
use Entity\Customer;
use Entity\Order;
use Entity\OrderItem;

$dbHandler = Connector::connect($config['host'], $config['port'], $config['db_name'], $config['db_user'], $config['db_password']);

$customers = new CustomersManager($dbHandler);
$books = new BooksManager($dbHandler);
$orders = new OrdersManager($dbHandler);
//$orderItems = new OrderItemsManager($dbHandler);


//$order1 = new Order('2', '55.44', '5');
//$customer1->setCustomerId($customers->insert($customer1));
//$customer1->setAddress('вул.Чехова');
//$customers->update($customer1);
$r = $orders->findAll();
foreach ($r as $o) {
    echo $o->getOrderId();
    echo $o->getCustomerId();
    echo $o->getAmount();
}

