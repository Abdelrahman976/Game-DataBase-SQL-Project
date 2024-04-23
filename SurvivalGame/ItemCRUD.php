<?php
require_once "Item.php";

if ( isset($_POST['name']) && isset($_POST['durability'])) {
    
    $item = new Item($_POST["name"], $_POST["durability"]);
    $item->add();
    header("Location: itemCRUD.php");
    return;
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
<header>
        <h1>Item Database</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </nav>
</header>
<div class="container">

   <div class="admin-object-form-container">

      <form  method="post">
         <h3>add a new item</h3>
         <input type="text" placeholder="enter item name" name="name" class="box" required>
         <input type="text" placeholder="enter item Durability" name="durability" class="box" required>
         <input type="submit" class="btn" name="add_item" value="Create">
      </form>

   </div>

   <div class="object-display">
      <table class="object-display-table">
         <thead>
         <tr>
            <th>item ID</th>
            <th>item name</th>
            <th>item durability</th>
            <th>action</th>
         </tr>
         </thead>
         <?php 
         $stmt = Item::view_all();
         while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
         <tr>
            <td><?php echo $row['ItemID']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Durability']; ?></td>
            <td>
              
            </td>
        </tr>
      
         
      <?php } ?>
      </table>
   </div>

</div>

<footer>
        <p>© 2024 Food Bank</p>
</footer>
</body>
<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

:root{
   --green:#27ae60;
   --black:#333;
   --white:#fff;
   --bg-color:#eee;
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
   --border:.1rem solid var(--black);
}

*{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   text-transform: capitalize;
}

header {
    background-color: #329443;
    color: #fff;
    padding: 10px;
    text-align: center;
}

footer {
    background-color: #329443;
    color: #fff;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
}

html{
   font-size: 62.5%;
   overflow-x: hidden;
}

.btn{
   display: block;
   width: 100%;
   cursor: pointer;
   border-radius: .5rem;
   margin-top: 1rem;
   font-size: 1.7rem;
   padding:1rem 3rem;
   background: var(--green);
   color:var(--white);
   text-align: center;
}

.btn:hover{
   background: var(--black);
}

.message{
   display: block;
   background: var(--bg-color);
   padding:1.5rem 1rem;
   font-size: 2rem;
   color:var(--black);
   margin-bottom: 2rem;
   text-align: center;
}

.container{
   max-width: 1200px;
   padding:2rem;
   margin:0 auto;
}

.admin-object-form-container.centered{
   display: flex;
   align-items: center;
   justify-content: center;
   min-height: 100vh;
   
}

.admin-object-form-container form{
   max-width: 50rem;
   margin:0 auto;
   padding:2rem;
   border-radius: .5rem;
   background: var(--bg-color);
}

.admin-object-form-container form h3{
   text-transform: uppercase;
   color:var(--black);
   margin-bottom: 1rem;
   text-align: center;
   font-size: 2.5rem;
}

.admin-object-form-container form .box{
   width: 100%;
   border-radius: .5rem;
   padding:1.2rem 1.5rem;
   font-size: 1.7rem;
   margin:1rem 0;
   background: var(--white);
   text-transform: none;
}

.object-display{
   margin:2rem 0;
}

.object-display .object-display-table{
   width: 100%;
   text-align: center;
}

.object-display .object-display-table thead{
   background: var(--bg-color);
}

.object-display .object-display-table th{
   padding:1rem;
   font-size: 2rem;
}


.object-display .object-display-table td{
   padding:1rem;
   font-size: 2rem;
   border-bottom: var(--border);
}

.object-display .object-display-table .btn:first-child{
   margin-top: 0;
}

.object-display .object-display-table .btn:last-child{
   background: crimson;
}

.object-display .object-display-table .btn:last-child:hover{
   background: var(--black);
}









@media (max-width:991px){

   html{
      font-size: 55%;
   }

}

@media (max-width:768px){

   .object-display{
      overflow-y:scroll;
   }

   .object-display .object-display-table{
      width: 80rem;
   }

}

@media (max-width:450px){

   html{
      font-size: 50%;
   }

}
</style>
</html>