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

$books = new BooksManager($dbHandler);
$booksResult = $books->findAll();
$customers = new CustomersManager($dbHandler);
$customersResult = $customers->findAll();
$orders = new OrdersManager($dbHandler);
$ordersResult = $orders->findAll();
$orderItems = new OrderItemsManager($dbHandler);
$orderItemsResult = $orderItems->findAll();

$booksOutPut = [];
foreach ($booksResult as $i) {
    $booksOutPut[] = (array)$i;
}

$customersOutPut = [];
foreach ($customersResult as $i) {
    $customersOutPut[] = (array)$i;
}

$ordersOutPut = [];
foreach ($ordersResult as $i) {
    $ordersOutPut[] = (array)$i;
}

$orderItemsOutPut = [];
foreach ($orderItemsResult as $i) {
    $orderItemsOutPut[] = (array)$i;
}


Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);
$indexPage = $twig->loadTemplate('index.html.twig');
echo $indexPage->render(array(
    'title' => 'Структура бази даних',
    'tableBook' => 'Book',
    'headBookArray' => array('ISBN', 'Author', 'Title', 'Price'),
    'tableBookData' => $booksOutPut,
    'tableCustomer' => 'Customer',
    'headCustomerArray' => array('CustomerId', 'Name', 'Address', 'City'),
    'tableCustomerData' => $customersOutPut,
    'tableOrder' => 'Order',
    'headOrderArray' => array('OrderId', 'CustomerId', 'Amount'),
    'tableOrderData' => $ordersOutPut,
    'tableOrderItem' => 'OrderItem',
    'headOrderItemArray' => array('OrderId', 'ISBN', 'Quantity'),
    'tableOrderItemData' => $orderItemsOutPut,
));