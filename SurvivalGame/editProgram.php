<?php
require_once 'pdo.php';

// Assuming $world_id is obtained safely from user input or application context
//echo "<h1>VALUE WANTED: " . $_SESSION['valueWorldID'] . "</h1>";
$worldID = $_GET['worldIDValue']; // Example ID, replace or modify as needed

if ($worldID !== null) {
    $stmt = $pdo->prepare("CALL GetPlayersInWorld(:worldID)");
    $stmt->execute([':worldID' => $worldID]);
    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $players = []; // Default to an empty array if no WorldID is provided
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Player</title>
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
<table>
        <thead>
        <tr>
            <th>Player ID</th>
            <th>Username</th>
            <th>Status</th>
            <th>XCoordinate</th>
            <th>YCoordinate</th>
            <th>ZCoordinate</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($players as $player): ?>
            <tr>
                <td><?php echo htmlspecialchars($player['PlayerID']); ?></td>
                <td><?php echo htmlspecialchars($player['Username']); ?></td>
                <td><?php echo htmlspecialchars($player['Status']); ?></td>
                <td><?php echo htmlspecialchars($player['XCoordinate']); ?></td>
                <td><?php echo htmlspecialchars($player['YCoordinate']); ?></td>
                <td><?php echo htmlspecialchars($player['ZCoordinate']); ?></td>
                <td><a href="PlayerEdit.php?PlayerID=<?php echo $player['PlayerID']; ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</table>
</body>
</html>
