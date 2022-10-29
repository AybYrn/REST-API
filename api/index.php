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
$app->get('/product/searchProductName/:name', 'getProductByName'); //customer
$app->get('/product/searchProductNamefromMarket/:id/:name', 'getProductByNamefromMarket');
$app->get('/product/productByMarket/:id', 'getProductByMarketId');  //customer


$app->get('/cart/:id', 'getCart');
$app->get('/purchaseHistory', 'getAllPurchaseHistory');
$app->get('/purchaseHistory/:id', 'getPurchaseHistory');

 $app->post('/product', 'addProduct'); 
// $app->put('/product/:id', 'updateProduct');
 $app->delete('/product/:id', 'deleteproduct');

$app->run();

?>


