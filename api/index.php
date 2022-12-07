<?php
require 'Slim/Slim.php';
require 'router.php';
require 'database.php';
use Slim\Slim;
\Slim\Slim::registerAutoloader();

$app = new Slim();

$app->get('/customers', 'getCustomers'); //get all customers
$app->get('/customers/:id',  'getCustomerById');//get customer by id
$app->get('/customers/search/:name', 'getCustomerByName'); //search customers by name

$app->get('/markets', 'getMarkets'); //get all markets
$app->get('/markets/:id',  'getMarketById'); //get markets by id
$app->get('/markets/search/:name', 'getMarketByName'); //search market by name

$app->get('/products/:page', 'getProducts'); //get all products
$app->get('/productsCount', 'getProductCount'); //get all products count
$app->get('/products/search/id/:id', 'getProductById'); // get product by id
$app->get('/products/search/name/:name', 'getProductByName'); //get product by name
$app->get('/products/search/market/:id', 'getProductByMarketId'); //get products belong to the market by market id
$app->get('/products/search/:id/:name', 'getProductByNamefromMarket'); //get product by name based on market
$app->get('/products/pic/:id', 'getProductPic'); //get product pictures
$app->post('/products', 'addProduct'); //Insertion of product by market.
$app->put('/products/:id', 'updateProduct'); //Update product information for market user.
$app->delete('/products/:id', 'deleteProduct'); //Delete product for market user.


$app->get('/cart/:id', 'getCart'); //get cart. It shows products that is in customer's cart. 
$app->get('/purchase', 'getAllPurchaseHistory'); //get purchase history. It enables customer to see previous purchases.
$app->get('/purchase/:id', 'getPurchaseHistory'); //get purchase history by customer id. 
                                                         //It is for market user to show specific purchase of customer.

$app->put('/profile/:id', 'updateProfile'); //Update customer details
 
$app->post('/cart', 'addCart'); //To insert a product to cart by customer user.
$app->put('/cart/:idCust/:idProduct', 'updateCart'); //Update cart by customer.
$app->delete('/cart/:idCust/:idProduct', 'deleteCart'); //Delete cart by customer from cart."
 
$app->run();


