<?php

require_once "pdo.php";

$table = "slot";
class Slot {
    public $SlotID;
    public $Quantity;

    // Constructor
    public function __construct($Quantity) {
        $this->Quantity = $Quantity;
    }
        
    public function add() {
        global $pdo, $table;
        $sql = "INSERT INTO {$table} (Quantity) 
        VALUES (:Quantity)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':Quantity' => $this->Quantity));
        $stmt = $pdo->query("SELECT LAST_INSERT_ID()");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->SlotID = $row['LAST_INSERT_ID()'];
        return 0;
    }
        
    public function read() {
        global $pdo, $table;
        $sql = "SELECT * FROM {$table} WHERE SlotID = :SlotID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['SlotID' => $this->SlotID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        
    public function edit() {
        global $pdo, $table;
        $sql = "UPDATE {$table} SET Quantity = :Quantity WHERE SlotID = :SlotID";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['SlotID' => $this->SlotID,
        'Quantity' => $this->Quantity]);
    }
        
    public function remove() {
        global $pdo, $table;
        $sql = "DELETE FROM {$table} WHERE SlotID = :SlotID";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['SlotID' => $this->SlotID]);
    }
        
    public static function view_all(){
        global $pdo, $table;
        $stmt = $pdo->query("SELECT * FROM {$table}");
        return $stmt;
    }
        
    public function getId()
    {
        return $this->SlotID;
    }
        
    public function setId($SlotID): self
    {
        $this->SlotID = $SlotID;
        
        return $this;
    }
        
}