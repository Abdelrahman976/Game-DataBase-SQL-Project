<?php
require_once 'pdo.php'; // Ensure this file contains the correct PDO connection setup

try {
    $stmt = $pdo->query("SELECT * FROM MobDropsView");
    $mobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mob Drops</title>
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
<h1>Mob Drops Information</h1>
<table>
    <tr>
        <th>Mob ID</th>
        <th>Health</th>
        <th>Is Hostile</th>
        <th>Attack Damage</th>
        <th>Spawn Condition</th>
        <th>Type</th>
        <th>Drop Quantity</th>
        <th>Item Name</th>
    </tr>
    <?php foreach ($mobs as $mob): ?>
        <tr>
            <td><?php echo htmlspecialchars($mob['MobiD']); ?></td>
            <td><?php echo htmlspecialchars($mob['Health']); ?></td>
            <td><?php echo htmlspecialchars($mob['IsHostile'] ? 'Yes' : 'No'); ?></td>
            <td><?php echo htmlspecialchars($mob['AttackDamage']); ?></td>
            <td><?php echo htmlspecialchars($mob['SpawnCondition']); ?></td>
            <td><?php echo htmlspecialchars($mob['Type']); ?></td>
            <td><?php echo htmlspecialchars($mob['DropQuantity']); ?></td>
            <td><?php echo htmlspecialchars($mob['ItemName']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
