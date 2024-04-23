<?php

require_once 'pdo.php';
require_once 'Player.php';


 if(isset($_GET['PlayerID'])) {
    $PlayerID = $_GET['PlayerID'];

    // Prepare and execute the SQL query
    $sql = 'declare @pid int = :PlayerID; SELECT * FROM dbo.ViewPlayerDetails(@pid);';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['PlayerID'=> $PlayerID]);

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header("Location: PlayerView.php");
    return;
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet/text" href="static/css/player.css">
    <title>Survival Game Player Account</title>
    
</head>
<body>
    <div class="container">
        <h1>Player Account</h1>

        <form action="Player.php" method="get">
         <h3>Player</h3>
        <div class="search-container">
            <input type="number" name="PlayerID" class="search-box" placeholder="Search player...">
            <button type="submit"  class="search-btn">Search</button>
        </div>
        </form>
        <div class="player-info">
            <h2>Welcome </h2>
            <p>Level: 15</p>
            <p>Experience: 3500</p>
        </div>
        <div class="stats">
         
         
        <?php if(isset($results) && !empty($results)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Player ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <!-- Add more table headers for other fields if needed -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo $row['PlayerID']; ?></td>
                        <td><?php echo $row['Username']; ?></td>
                        
                        <!-- Add more cells for other fields if needed -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No player found with the provided ID.</p>
    <?php endif; ?>
    
    </div>

</body>
</html>
