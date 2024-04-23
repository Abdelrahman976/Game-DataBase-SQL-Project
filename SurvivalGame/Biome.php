<?php
require_once "pdo.php";

$table = "biome";

class Biome{
private $BiomeName;
private $Rarity;

public function __construct($BiomeName="", $Rarity=""){
    $this->BiomeName = $BiomeName;
    $this->Rarity = $Rarity;
}

public function add() {
        global $pdo, $table;
        $sql = "INSERT INTO {$table} (BiomeName, Rarity) 
        VALUES (:BiomeName, :Rarity)"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':BiomeName' => $this->BiomeName,
        ':Rarity' => $this->Rarity));
        $stmt = $pdo->query("SELECT LAST_INSERT_ID()");  
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->BiomeName = $row['LAST_INSERT_ID()']; 
        return 0;
    }

    public function read() {
        global $pdo, $table;
        $sql = "SELECT * FROM {$table} WHERE BiomeName = :BiomeName";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['BiomeName' => $this->BiomeName]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function edit() {
        global $pdo, $table;
        $sql = "UPDATE {$table} SET Rarity = :Rarity
        WHERE BiomeName = :BiomeName";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['BiomeName' => $this->BiomeName,
        'Rarity' => $this->Rarity]);
    }    

   public function remove() {
        global $pdo, $table;
        $sql = "DELETE FROM {$table} WHERE BiomeName = :BiomeName";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['BiomeName' => $this->BiomeName]);
    }

    public static function view_all(){
        global $pdo, $table;
        $stmt = $pdo->query("SELECT * FROM {$table}");
        return $stmt;
    }

}