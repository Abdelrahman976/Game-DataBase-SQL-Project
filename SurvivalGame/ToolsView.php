<?php
require_once 'pdo.php'; // Ensure this file contains the correct PDO connection setup

try {
    $stmt = $pdo->query("SELECT * FROM Tool");
    $tools = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Tools Overview</title>
</head>
<body>
    <div class="container">
        <h1 class="title">Tool Information</h1>
        <div class="table-cont">
            <table class="object-display-table">
                <thead>
                    <tr>
                        <th>Tool Name</th>
                        <th>Durability</th>
                        <th>Damage</th>
                    </tr>
                </thead>
                <?php foreach ($tools as $tool): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($tool['ToolName']); ?></td>
                        <td><?php echo htmlspecialchars($tool['Durability']); ?></td>
                        <td><?php echo htmlspecialchars($tool['Damage']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
