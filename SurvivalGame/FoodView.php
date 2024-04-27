<?php
require_once 'pdo.php'; // Ensure this file contains the correct PDO connection setup

try {
    $stmt = $pdo->query("SELECT * FROM Food");
    $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Could not connect to the database :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/CRUD.css">
    <title>Food Overview</title>
</head>
<body>
<div class="container">
    <h1 class="title">Food Information</h1>
        <div class="table-cont">
            <table class="object-display-table">
                <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Hunger Points</th>
                    </tr>
                </thead>
                <?php foreach ($foods as $food): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($food['FoodName']); ?></td>
                        <td><?php echo htmlspecialchars($food['HungerPoints']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
</div>
</body>
</html>
