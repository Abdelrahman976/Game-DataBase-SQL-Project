<?php
require_once "pdo.php";

$table ="world";
//setters and getters?

class World{
    private $WorldID = 0;
    private $WorldName;
    private $Seed = 0;
    private $WorldType;
    private $TimeCreated;
    private $LastAccessed;

    public function __construct($WorldName="", $Seed=0,$WorldType="",$TimeCreated="",$LastAccessed=""){
        $this->WorldName = $WorldName;
        $this->WorldType = $WorldType;
        $this->Seed = $Seed;
        $this->TimeCreated = $TimeCreated;
        $this->LastAccessed =$LastAccessed;

    }
    public function add() {
        global $pdo, $table;
        $sql = "INSERT INTO {$table} (WorldName, WorldType, TimeCreated, LastAccessed, Seed) 
        VALUES (:WorldName, :WorldType, :TimeCreated, :LastAccessed, :Seed)"; //last accessed?
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':WorldName' => $this->WorldName,
        ':WorldType' => $this->WorldType,
        ':TimeCreated' => $this->TimeCreated,
        ':LastAccessed' => $this->LastAccessed,
        ':Seed'=> $this->Seed));
        $stmt = $pdo->query("SELECT LAST_INSERT_ID()");  //what is this?
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->WorldID = $row['LAST_INSERT_ID()'];
        return 0;
    }

    public function read() {
        global $pdo, $table;
        $sql = "SELECT * FROM {$table} WHERE WorldID = :WorldID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['WorldID' => $this->WorldID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function edit() {
        global $pdo, $table;
        $sql = "UPDATE {$table} SET worldName = :WorldName, worldType = :WorldType,
        dateCreated = :TimeCreated, lastAccessed = :LastAccessed,
        seed = :Seed WHERE id = :WorldID";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['WorldID' => $this->WorldID,
        'WorldName' => $this->WorldName,
        'WorldType' => $this->WorldType,
        'TimeCreated' => $this->TimeCreated,
        'LastAccessed' => $this->LastAccessed,
        'Seed' => $this->Seed]);
    }    

    public function remove() {
        global $pdo, $table;
        $sql = "DELETE FROM {$table} WHERE WorldID= :WorldID";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['WorldID' => $this->WorldID]);
    }

    public static function view_all(){
        global $pdo, $table;
        $stmt = $pdo->query("SELECT * FROM {$table}");
        return $stmt;
    }

}