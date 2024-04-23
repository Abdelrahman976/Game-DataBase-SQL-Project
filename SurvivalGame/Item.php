<?php
require_once "pdo.php";

$table = "item";
class Item {
    // Properties
    private $ItemID;
    private $Name;
    private $Durability;

    // Constructor
    public function __construct( $Name, $Durability) {
        $this->Name = $Name;
        $this->Durability = $Durability;
    }
    
        public function add() {
            global $pdo, $table;
            $sql = "INSERT INTO {$table} (Name, Durability) 
            VALUES (:Name, :Durability)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':Name' => $this->Name,
            ':Durability' => $this->Durability));
            $stmt = $pdo->query("SELECT LAST_INSERT_ID()");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->ItemID = $row['LAST_INSERT_ID()'];
            return 0;
        }
    
        public function read() {
            global $pdo, $table;
            $sql = "SELECT * FROM {$table} WHERE ItemID = :ItemID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['ItemID' => $this->ItemID]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        public function edit() {
            global $pdo, $table;
            $sql = "UPDATE {$table} SET Name = :Name, Durability = :Durability WHERE ItemID = :ItemID";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute(['ItemID' => $this->ItemID,
            'Name' => $this->Name,
            'Durability' => $this->Durability]);
        }
    
        public function remove() {
            global $pdo, $table;
            $sql = "DELETE FROM {$table} WHERE ItemID = :ItemID";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute(['ItemID' => $this->ItemID]);
        }
    
        public static function view_all(){
            global $pdo, $table;
            $stmt = $pdo->query("SELECT * FROM {$table}");
            return $stmt;
        }
    
        public function getId()
        {
            return $this->ItemID;
        }
    
        public function setId($ItemID): self
        {
            $this->ItemID = $ItemID;
    
            return $this;
        }
    
    }

