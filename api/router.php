<?php

// Used for retrieve data of all customer.

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

// Used for retrieve data of a customer by id.

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

// Used for retrieve data of a customer by name.

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

// Used for retreive data of all markets.

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

// Used for retreive data of one market by id.

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

// Used for retreive data of one market by name.

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

/// Used for retreive data of all products.

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

// Used for retreive data of one product by id.

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

// Used for retreive data of products by name.

function getProductByName($name) {    
    $query = "SELECT name, normal_price, disc_price, expr_date FROM product "
            . "WHERE UPPER(name) LIKE "
            . '"%' . $name . '%"';

    try {
        global $db;
        $stmt = $db->query($query);
        $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($product);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

// Used for retreive data of all products supplied by market and search by product name.

function getProductByNamefromMarket($id, $name) {    
    $query = "SELECT product.id, product.name, product.stock, product.normal_price, product.disc_price, product.expr_date "
            . "FROM product "
            . "WHERE ". $id . " = product.market_id "
            . "AND UPPER(name) LIKE "
            . '"%' . $name . '%"';
    
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

// Used for retreive data of all products supplied by market.

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

// Used for retreive data of purchase history by specific customer.

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

// Used for retreive data of all purchase history.

function getAllPurchaseHistory() {
    $query = "SELECT purchase_history.price, purchase_history.quantity, purchase_history.date, "
            . "product.id, product.name, "
            . "user.id, user.name "
            . "FROM purchase_history "
            . "JOIN product "
            . "ON product.id = purchase_history.product_id "
            . "JOIN user "
            . "ON user.id = purchase_history.cust_id ";
    
    try {
        global $db;
        $stmt = $db->query($query);
        $purchase_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($purchase_history);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';        
    }

}

// Used for retreive data of cart.

function getCart($id) {
    $query = "SELECT product.name, cart.product_id, cart.cust_id, cart.amount FROM cart "
            . "INNER JOIN product "
            . "ON cart.product_id = product.id "
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

function addProduct() {
    global $app;
    $request = $app->request();
    $products = json_decode($request->getBody());
    $name = $products->name;
    $stock = $products->stock;
    $marketId = $products->market_id;
    $normalPrice = $products->normal_price;
    $discPrice = $products->disc_price;
    $exprDate = $products->expr_date;
    
    $query = "INSERT INTO product"
            . "(name, stock, market_id, normal_price, disc_price, expr_date) "
            . "VALUES ('$name', '$stock', '$marketId', '$normalPrice', '$discPrice', '$exprDate') ";
    
    try {
       global $db;
       $db->exec($query);
       $products->id = $db->lastInsertId();
       echo json_encode($products);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function deleteProduct($id) {
    try {
        global $db;
        $stmt = $db->prepare("DELETE FROM product WHERE id = ? ");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function updateProduct($id) {
    global $app;
    $request = $app->request();
    $products = json_decode($request->getBody());
    $name = $products->name;
    $stock = $products->stock;
    $normalPrice = $products->normal_price;
    $discPrice = $products->disc_price;
    $exprDate = $products->expr_date;
    
    $query = "UPDATE product "
            . "SET name = '$name', "
            . "stock = '$stock', normal_price = '$normalPrice',"
            . " disc_price = '$discPrice', expr_date = '$exprDate' "
            . "WHERE id = ? "; 
            
    try {
       global $db;
       $stmt = $db->prepare($query);
       $stmt->execute([$id]);
       echo json_encode($products);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function addCart() {
    global $app;
    $request = $app->request();
    $cart = json_decode($request->getBody());
    $productId = $cart->product_id;
    $custId = $cart->cust_id;
    $amount = $cart->amount;
    
    $query = "INSERT INTO cart"
            . "(product_id, cust_id, amount) "
            . "VALUES ('$productId', '$custId', '$amount') ";
    
    try {
       global $db;
       $db->exec($query);
       echo json_encode($cart);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

}

function updateCart($idC, $idP) {
    global $app;
    $request = $app->request();
    $cart = json_decode($request->getBody());
    $amount = $cart->amount;
    
    $query = "UPDATE cart "
            . "SET amount = '$amount' "
            . "WHERE product_id = ? "
            . "AND cust_id = ? ";
    
    try {
       global $db;
       $stmt = $db->prepare($query);
       $stmt->execute([$idP, $idC]);
       echo json_encode($cart);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }
}

function deleteCart($idC, $idP) {
    try {
        global $db;
        $stmt = $db->prepare("DELETE FROM cart WHERE product_id = ? AND cust_id = ? ");
        $stmt->execute([$idP, $idC]);
    } catch (PDOException $e) {
        echo '{"error": {"text":' . $e->getMessage() . '}}';
    }

}