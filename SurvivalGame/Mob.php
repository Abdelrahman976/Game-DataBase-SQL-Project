<?php

require_once "pdo.php";

$table = "mob";

class Mob {
    // Properties
    private $MobiD = 0;
    private $Type;
    private $IsHostile = false;
    private $AttackDamage;
    private $SpawnCondition;
    private $Health;

    // Constructor
    public function __construct($Health,$IsHostile = false, $AttackDamage, $SpawnCondition, $Type) {
        $this->Health = $Health;
        $this->IsHostile = $IsHostile;
        $this->AttackDamage = $AttackDamage;
        $this->SpawnCondition = $SpawnCondition;
        $this->Type = $Type;
    }

    public function add() {
        global $pdo, $table;
        $sql = "INSERT INTO {$table} (Health,IsHostile, AttackDamage, SpawnCondition, Type) 
        VALUES (:Health, :IsHostile, :AttackDamage, :SpawnCondition, :Type)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
        ':Health' => $this->Health,
        ':IsHostile' => $this->IsHostile,
        ':AttackDamage' => $this->AttackDamage,
        ':SpawnCondition' => $this->SpawnCondition,
        ':Type' => $this->Type));
        $stmt = $pdo->query("SELECT LAST_INSERT_ID()");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->MobID = $row['LAST_INSERT_ID()'];
        return 0;
    }

    public function read() {
        global $pdo, $table;
        $sql = "SELECT * FROM {$table} WHERE MobID = :MobID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['MobiD' => $this->MobiD]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function edit() {
        global $pdo, $table;
        $sql = "UPDATE {$table} SET Type = :Type,
        IsHostile = :IsHostile, AttackDamage = :AttackDamage, SpawnCondition = :SpawnCondition,
        Health = :Health WHERE MobiD = :MobiD";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['MobiD' => $this->MobiD,
        'Type' => $this->Type,
        'IsHostile' => $this->IsHostile,
        'AttackDamage' => $this->AttackDamage,
        'SpawnCondition' => $this->SpawnCondition,
        'Health' => $this->Health,]);
    }

    public function remove() {
        global $pdo, $table;
        $sql = "DELETE FROM {$table} WHERE MobiD = :MobiD";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['MobiD' => $this->MobiD]);
    }

    public static function view_all(){
        global $pdo, $table;
        $stmt = $pdo->query("SELECT * FROM {$table}");
        return $stmt;
    }


}


