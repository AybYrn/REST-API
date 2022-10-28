<?php

/* * ** CUSTOMER *** */

function getCustomers() {
    $query = "SELECT user.name, user.email, customer.address, customer.register_date FROM user "
            . "INNER JOIN customer "
            . "ON user.id = customer.id";

    try {
        global $db;
        $stmt = $db->query($query);
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($customers);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function getCustomerById($id) {
    $query = "SELECT user.name, user.email, customer.address, customer.register_date FROM user "
            . "INNER JOIN customer "
            . "ON user.id = customer.id "
            . "WHERE customer.id = ? ";

    try {
        global $db;
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($customer);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function getCustomerByName($name) {
    $query = "SELECT user.email, customer.address, customer.register_date FROM user "
            . "INNER JOIN customer "
            . "ON user.id = customer.id "
            . "WHERE UPPER(name) LIKE " . '"%' . $name . '%"';

    try {
        global $db;
        $stmt = $db->query($query);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($customer);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

/* * ** MARKET *** */

function getMarkets() {
    $query = "SELECT user.name, user.email, market.address FROM user "
            . "INNER JOIN market "
            . "ON user.id = market.id";

    try {
        global $db;
        $stmt = $db->query($query);
        $markets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($markets);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function getMarketById($id) {
    $query = "SELECT user.name, user.email, market.address FROM user "
            . "INNER JOIN market "
            . "ON user.id = market.id "
            . "WHERE market.id = ? ";

    try {
        global $db;
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $market = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($market);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function getMarketByName($name) {
    $query = "SELECT user.email, market.address FROM user "
            . "INNER JOIN market "
            . "ON user.id = market.id "
            . "WHERE UPPER(name) LIKE " . '"%' . $name . '%"';

    try {
        global $db;
        $stmt = $db->query($query);
        $market = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($market);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

/* * ** PRODUCT *** */

function getProducts() {
    $query = "SELECT name, normal_price, expr_date FROM product ";

    try {
        global $db;
        $stmt = $db->query($query);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($products);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function getProductById($id) {
    $query = "SELECT name, normal_price, expr_date FROM product WHERE id = ? ";

    try {
        global $db;
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($product);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function getProductByName($name) {
    $query = "SELECT normal_price, expr_date FROM product "
            . "WHERE UPPER(name) LIKE " . '"%' . $name . '%"';

    try {
        global $db;
        $stmt = $db->query($query);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($product);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function getProductByMarketId($id) {
    $query = "SELECT name, normal_price, disc_price, expr_date FROM product WHERE market_id = ? ";

    try {
        global $db;
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($products);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function getPurchaseHistory($id) {
    $query = "SELECT purchase_history.price, purchase_history.quantity, purchase_history.date, "
            . "product.id, product.name, "
            . "user.id, user.name "
            . "FROM purchase_history "
            . "JOIN product "
            . "ON product.id = purchase_history.product_id "
            . "JOIN user "
            . "ON user.id = purchase_history.cust_id "
            . "WHERE product.market_id = ? ";

    try {
        global $db;
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $purchase_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($purchase_history);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

/* * ** CART *** */

function getCart($id) {
    $query = "SELECT product_id, cust_id, amount FROM cart "
            . "WHERE  cust_id = ? ";

    try {
        global $db;
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($cart);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}
