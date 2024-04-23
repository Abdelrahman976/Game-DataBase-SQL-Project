<?php
require_once "Player.php";
require_once "pdo.php";

try {
    // Assuming $world_id is obtained safely from user input or application context

    $world_id = $_GET['worldIDValue']; // Example ID, replace or modify as needed

    $stmt = $pdo->prepare("CALL GetPlayerDetailsByWorld(:world_id)");
    $stmt->bindParam(':world_id', $world_id, PDO::PARAM_INT);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error executing stored procedure: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="static/css/CRUD.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <title>Item CRUD</title>
</head>
<body>
<table border="1">
    <thead>
    <tr>
        <th>Player ID</th>
        <th>Username</th>
        <th>Status</th>
        <th>X Coordinate</th>
        <th>Y Coordinate</th>
        <th>Z Coordinate</th>
        <th>Slot 1</th>
        <th>Slot 2</th>
        <th>Slot 3</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $row) : ?>
        <tr>
            <td><?php echo htmlspecialchars($row['PlayerID']); ?></td>
            <td><?php echo htmlspecialchars($row['Username']); ?></td>
            <td><?php echo htmlspecialchars($row['Status']); ?></td>
            <td><?php echo htmlspecialchars($row['XCoordinate']); ?></td>
            <td><?php echo htmlspecialchars($row['YCoordinate']); ?></td>
            <td><?php echo htmlspecialchars($row['ZCoordinate']); ?></td>
            <td><?php echo htmlspecialchars($row['Slot1']); ?></td>
            <td><?php echo htmlspecialchars($row['Slot2']); ?></td>
            <td><?php echo htmlspecialchars($row['Slot3']); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>