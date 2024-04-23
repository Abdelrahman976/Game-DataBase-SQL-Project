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
    <title>Tools Overview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {background-color: #f5f5f5;}
    </style>
</head>
<body>
<h1>Tool Information</h1>
<table>
    <tr>
        <th>Tool Name</th>
        <th>Durability</th>
        <th>Damage</th>
    </tr>
    <?php foreach ($tools as $tool): ?>
        <tr>
            <td><?php echo htmlspecialchars($tool['ToolName']); ?></td>
            <td><?php echo htmlspecialchars($tool['Durability']); ?></td>
            <td><?php echo htmlspecialchars($tool['Damage']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
