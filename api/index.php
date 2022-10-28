<?php
require 'Slim/Slim.php';
require 'router.php';
require 'database.php';
use Slim\Slim;
\Slim\Slim::registerAutoloader();

$app = new Slim();

$app->get('/customers', 'getCustomers');
$app->get('/customer/:id',  'getCustomerById');
$app->get('/customer/searchCustomerName/:name', 'getCustomerByName');

$app->get('/markets', 'getMarkets');
$app->get('/market/:id',  'getMarketById');
$app->get('/market/searchMarketName/:name', 'getMarketByName');

$app->get('/products', 'getProducts');
$app->get('/product/:id', 'getProductById');
$app->get('/product/searchProductName/:name', 'getProductByName');
$app->get('/product/productByMarket/:id', 'getProductByMarketId');


$app->get('/cart/:id', 'getCart');
$app->get('/purchaseHistory/:id', 'getPurchaseHistory');

$app->run();

?>


