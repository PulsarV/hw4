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
$customersResult = $customers->findAll();
$books = new BooksManager($dbHandler);
$booksResult = $books->findAll();
$orders = new OrdersManager($dbHandler);
$ordersResult = $orders->findAll();
$orderItems = new OrderItemsManager($dbHandler);
$orderItemsResult = $orderItems->findAll();

$booksOutPut = '<tr><th>ISBN</th><th>Author</th><th>Title</th><th>Price</th></tr>';

foreach ($booksResult as $i) {
    $booksOutPut .= '<tr><td>' . $i->getIsbn() . '</td><td>' . $i->getAuthor() . '</td><td>' . $i->getTitle() . '</td><td>' . $i->getPrice() . '</td></tr>';
}


Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);
$indexPage = $twig->loadTemplate('index.html.twig');
echo $indexPage->render(array(
    'title' => 'Структура бази даних',
    'tableBook' => 'Book',
    'tableBookData' => Array($booksOutPut),
));



/*$r = $orders->findAll();
foreach ($r as $o) {
    echo $o->getOrderId();
    echo $o->getCustomerId();
    echo $o->getAmount();
}

