<?php
require_once 'pdo.php';

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    try {
        $stmt = $pdo->prepare('SELECT * FROM player WHERE Username = :username');
        $stmt->execute(['username' => $username]);
        
        $player = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($player) {
            $PlayerID = $player['PlayerID'];
            if ($PlayerID == $_POST['PlayerID']) {
                $_SESSION['username'] = $player['Username'];
                $_SESSION['PlayerID'] = $player['PlayerID'];
                header('Location: home.php');
                exit;
            } else {
                $error = 'Invalid PlayerID.';
            }
        } else {
            $error = 'User not found.';
        }
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="static/css/login.css">
        <title>Login</title>
    </head>

    <body>
        <section class="container">
            <header><h1>Login</h1></header>
            
                <?php if ($error): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>

                <form action="login.php" method="POST" class="form">
                    <div class = "input-box">
                        <label>Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>

                    <div class = "input-box">
                        <label>PlayerID</label>
                        <input type="text" id="PlayerID" name="PlayerID" placeholder="Enter your PlayerID" required>
                    </div>

                    <button>Submit</button>
                </form>

        </section>
    </body>

</html>
