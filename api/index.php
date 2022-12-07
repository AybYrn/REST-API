<?php
require 'Slim/Slim.php';
require 'router.php';
require 'database.php';
use Slim\Slim;
\Slim\Slim::registerAutoloader();

$app = new Slim();

$app->get('/customers', 'getCustomers'); //get all customers
$app->get('/customer/:id',  'getCustomerById');//get customer by id
$app->get('/customer/searchCustomerName/:name', 'getCustomerByName'); //search customers by name

$app->get('/markets', 'getMarkets'); //get all markets
$app->get('/markets/:id',  'getMarketById'); //get markets by id
$app->get('/markets/search/:name', 'getMarketByName'); //search market by name

$app->get('/products/:page', 'getProducts'); //get all products
$app->get('/productsCount', 'getProductCount'); //get all products
$app->get('/products/:id', 'getProductById'); // get product by id
$app->get('/products/searchProductName/:name', 'getProductByName'); //get product by name
$app->get('/products/searchProductNamefromMarket/:id/:name', 'getProductByNamefromMarket'); //get product by name based on market
$app->get('/products/productByMarket/:id', 'getProductByMarketId'); //get products belong to the market by market id
$app->get('/products/pic/:id', 'getProductPic'); //get product pictures

$app->get('/cart/:id', 'getCart'); //get cart. It shows products that is in customer's cart. 
$app->get('/purchaseHistory', 'getAllPurchaseHistory'); //get purchase history. It enables customer to see previous purchases.
$app->get('/purchaseHistory/:id', 'getPurchaseHistory'); //get purchase history by customer id. 
                                                         //It is for market user to show specific purchase of customer.

$app->post('/product', 'addProduct'); //Insertion of product by market.
$app->put('/product/:id', 'updateProduct'); //Update product information for market user.
$app->delete('/product/:id', 'deleteProduct'); //Delete product for market user.

$app->put('/profile/:id', 'updateProfile'); //Update customer details
 
$app->post('/cart', 'addCart'); //To insert a product to cart by customer user.
$app->put('/cart/:idCust/:idProduct', 'updateCart'); //Update cart by customer.
$app->delete('/cart/:idCust/:idProduct', 'deleteCart'); //Delete cart by customer from cart."
 
$app->run();


