<?php
require_once 'pdo.php';

$targetWorldID = $_GET['worldIDValue'] ?? 1; // Default or get from URL

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['playerID'])) {
    // Update player's WorldID when the 'Invite' button is clicked
    $playerID = $_POST['playerID'];
    $stmt = $pdo->prepare("UPDATE Player SET WorldID = :newWorldID WHERE PlayerID = :playerID");
    $stmt->execute([
        ':newWorldID' => $targetWorldID,
        ':playerID' => $playerID
    ]);

    header("Location: home.php"); // Refresh the page
    exit;
}

// Fetch players not in the specified world
$stmt = $pdo->prepare("CALL GetPlayersNotInWorld(:worldID)");
$stmt->execute([':worldID' => $targetWorldID]);
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor(); // Close the cursor to free the connection for the next query

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/CRUD.css">
    <title>Invite Player</title>
</head>
<body>
<div class="container">
    <h1 class="title">Invite Players Not in World <?= htmlspecialchars($targetWorldID) ?></h1>
        <div class="table-cont">
            <table class="object-display-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Current World</th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($players as $player): ?>
                    <tr>
                        <td><?= htmlspecialchars($player['Username']) ?></td>
                        <td><?= htmlspecialchars($player['WorldID']) ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="playerID" value="<?= $player['PlayerID'] ?>">
                                <button type="submit" class="btn">Invite</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
