<?php
include 'config.php';

$products = [];
$error = '';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $query = "SELECT * FROM products";
    $stmt = $pdo->query($query);
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Products List</h1>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['id'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($product['name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($product['price'] ?? ''); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo htmlspecialchars($product['id'] ?? ''); ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete.php?id=<?php echo htmlspecialchars($product['id'] ?? ''); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
