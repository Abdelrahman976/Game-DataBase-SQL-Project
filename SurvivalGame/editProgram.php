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
    <link rel="stylesheet" href="static/css/CRUD.css">

    <title>Edit Player</title>
</head>
<body>
<div class="container">
    <h1 class="title">Edit Players in World <?=$worldID?></h1>
        <div class="table-cont">
            <table class="object-display-table">
                <thead>
                    <tr>
                        <th>Player ID</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>XCoordinate</th>
                        <th>YCoordinate</th>
                        <th>ZCoordinate</th>
                        <th></th>
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
                            <td>
                                <a href="PlayerEdit.php?PlayerID=<?php echo $player['PlayerID']; ?>">
                                    <input type="button" class="btn" value="Edit">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
