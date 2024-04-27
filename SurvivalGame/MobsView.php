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
    <link rel="stylesheet" href="static/css/CRUD.css">
    <title>Mob Drops</title>
</head>
<body>
    <div class="container">
        <a href="./home.php">
            <button class="backBtn">
                <span style="font-size: 25px;">&larr;</span>
            </button>
        </a>
        <h1 class="title">Mob Drops Information</h1>
            <div class="table-cont">
                <table class="object-display-table">
                    <thead>
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
                    </thead>
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
            </div>
    </div>
</body>
</html>
