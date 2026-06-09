<?php
include 'config.php';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    echo "Connected successfully <br>";

    $query = "SELECT * FROM products";
    $stmt = $pdo->query($query);
    $products = $stmt->fetchAll();

    foreach ($products as $product) {
        echo htmlspecialchars($product['name']) . " - " . htmlspecialchars($product['price']) . "<br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
