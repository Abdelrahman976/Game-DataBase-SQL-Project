<?php
require_once 'pdo.php';
require_once 'Player.php';

if (isset($_POST['playerID'], $_POST['username'], $_POST['status'], $_POST['xCoordinate'], $_POST['yCoordinate'], $_POST['zCoordinate'])) {
    // Create a new Player object with the provided data
    $player = new Player($_POST['playerID'], $_POST['username'], $_POST['status'], $_POST['xCoordinate'], $_POST['yCoordinate'], $_POST['zCoordinate']);

    // Call the edit method to update player details
    $player->edit();

    // Redirect to the editProgram.php page after updating
    header("Location: home.php");
    return;
}

// Fetch player details if available
if (isset($_GET['PlayerID'])) {
    $playerID = $_GET['PlayerID'];

    // Fetch the player details from the database
    $sql = "SELECT * FROM Player WHERE PlayerID = :playerID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':playerID' => $playerID]);
    $player = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // If no PlayerID is provided, set $player to null
    $player = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/player.css">
    <title>Edit Player</title>
</head>
<body>
<div class="container">
    <h1>Edit Player</h1>
    <?php if ($player): ?>
        <form method="post" class="grid-form">
            <input type="hidden" name="playerID" value="<?php echo htmlspecialchars($player['PlayerID']); ?>">
            <div class="grid-row-1">
                <div class="grid-column">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($player['Username']); ?>" required>
                </div>
                <div class="grid-column">
                    <label for="status">Status</label>
                    <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($player['Status']); ?>" required>
                </div>
            </div>
            <div class="grid-row-2">
                <div class="grid-column">
                    <label for="xCoordinate">X Coordinate</label>
                    <input type="number" id="xCoordinate" name="xCoordinate" value="<?php echo htmlspecialchars($player['XCoordinate']); ?>" required>
                </div>
                <div class="grid-column">
                    <label for="yCoordinate">Y Coordinate</label>
                    <input type="number" id="yCoordinate" name="yCoordinate" value="<?php echo htmlspecialchars($player['YCoordinate']); ?>" required>
                </div>
                <div class="grid-column">
                    <label for="zCoordinate">Z Coordinate</label>
                    <input type="number" id="zCoordinate" name="zCoordinate" value="<?php echo htmlspecialchars($player['ZCoordinate']); ?>" required>
                </div>
            </div>
            <button type="submit" name="update_player">Update Player</button>
        </form>
    <?php else: ?>
        <p>No player found.</p>
    <?php endif; ?>
</div>
</body>
</html>
