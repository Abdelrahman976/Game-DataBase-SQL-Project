<?php
require_once "World.php";
require_once "pdo.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="static/css/style.css">
  <title>Survival Game</title>

</head>
<header>
    <nav>
        <a href="MobsView.php"><button class="btn">Mob</button></a>
        <a href="ToolsView.php"><button class="btn">Tools</button></a>
        <a href="FoodView.php"><button class="btn">Food</button></a>
    </nav>
</header>
<body>
  <div class="container">
    <div class="title">
      <h1>Survival Game Worlds</h1>
    </div>
<!--    <div class="searchopt">-->
<!--        <div class="searchbar">-->
<!--        <input type="search" id="searchInput" placeholder="Search...">-->
<!--        <button type="submit" id="searchButton">Search</button>-->
<!--        </div>-->
<!--        <div class="dropdown" ">-->
<!--            <button class="dropbtn" id="dropbtn"><span id="dropbtnText">Player</span> <span class="arrow" id="arrow">&#9660;</span></button>            <div class="dropdown-content" id="dropdownContent">-->
<!--              <a href="#" data-value="Player">Player</a>-->
<!--              <a href="#" data-value="World">World</a>-->
<!--              <a href="#" data-value="Biome">Biome</a>-->
<!--              <a href="#" data-value="Block">Block</a>-->
<!--              <a href="#" data-value="Slot">Slot</a>-->
<!--              <a href="#" data-value="Food">Food</a>-->
<!--              <a href="#" data-value="Tool">Tool</a>-->
<!--              <a href="#" data-value="Item">Item</a>-->
<!--              <a href="#" data-value="Mob">Mob</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div class="table-cont" id="databaseView">
        <table class="object-display-table">
            <thead>
            <tr>
                <th>WorldID</th>
                <th>Seed</th>
                <th>Type</th>
                <th>TimeCreated</th>
                <th>LastAccessed</th>
                <th>Action</th>
                <?php
                $stmt = World::view_all();
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
            </tr>
            </thead>
            <tr>
            <td><?php echo $row['WorldID']; ?></td>
            <td><?php echo $row['Seed']; ?></td>
            <td><?php echo $row['WorldType']; ?></td>
            <td><?php echo $row['TimeCreated']; ?></td>
            <td><?php echo $row['LastAccessed']; ?></td>
            <td>

            <form method="post">
                <a href="PlayerCRUD.php?worldIDValue=<?php echo $row['WorldID'] ?>">
                    <input type="button" class="btn" id="view<?php echo $row['WorldID']; ?>" value="View">
                </a>

               <a href="editProgram.php?worldIDValue=<?php echo $row['WorldID'] ?>">
                   <input type="button" class="btn" id="view<?php echo $row['WorldID']; ?>" value="Edit">
               </a>

                <a href="inviteplayer.php?worldIDValue=<?php echo $row['WorldID'] ?>">
                    <input type="button" class="btn" id="view<?php echo $row['WorldID']; ?>" value="Invite">
                </a>
            </form>
<!--                <button  id="view--><?php //echo $row['WorldID']; ?><!--">View</button>-->
<!--                <button >Edit</button>-->
            </td>
            </tr>
            <?php } ?>
        </table>
    </div>
  </div>
  <script>
    document.getElementById('dropbtn').addEventListener('click', function(event) {
        var dropdownContent = document.getElementById('dropdownContent');
        var arrow = document.getElementById('arrow');
        if (dropdownContent.style.display === 'block') {
          dropdownContent.style.display = 'none';
          arrow.classList.remove('rotate');
        } else {
          dropdownContent.style.display = 'block';
          arrow.classList.add('rotate');
        }
        event.stopPropagation();
      });
      
      document.querySelectorAll('.dropdown-content a').forEach(function(element) {
        element.addEventListener('click', function(e) {
          e.preventDefault();
          document.getElementById('dropbtnText').innerText = this.getAttribute('data-value');
          document.getElementById('dropdownContent').style.display = 'none';
          document.getElementById('arrow').classList.remove('rotate');
        });
      });
            
      document.addEventListener('click', function() {
        document.getElementById('dropdownContent').style.display = 'none';
        document.getElementById('arrow').classList.remove('rotate');
      });
  </script>
  <script>
      function saveID(worldID) {
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "saveId.php", true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function () {
              if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                  console.log('ID saved: ' + this.responseText); // Optional: Log server response
              }
          }
          xhr.send("worldID=" + worldID);
      }
  </script>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['worldID'])) {
      $worldID = $_POST['worldID'];
      // You can now use $worldID to perform any server-side processing
      echo "Received ID: " . $worldID; // Send back a response for debugging

      // Example: You could store this in a session variable
      session_start();
      $_SESSION['selectedWorldID'] = $worldID;
      // Further processing like database operations can be performed here
  }
  ?>
<!--<div>-->
<!--    --><?php //echo $_SESSION['selectedWorldID']; ?>
<!--</div>-->

</body>
</html>

