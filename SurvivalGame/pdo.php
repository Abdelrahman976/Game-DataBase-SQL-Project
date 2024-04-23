<?php
$options =[ PDO::ATTR_EMULATE_PREPARES => false];
try{
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=OnlineGame', 
'Team10','SurvivalGameDB', $options);
}


catch (PDOException $e) {
echo "Error!: " . $e->getMessage() . "<br/>";
}
