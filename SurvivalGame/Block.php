<?php
require_once "pdo.php";

$table = "block";

class Block{

    private $BlockID = 0;
    private $BlockType;
    private $IsCraftable = false;
    private $IsBreakable = false;
    private $Transparency =false;
    private $Texture;

    public function __construct($BlockType="",$Texture="", $IsCraftable ,$IsBreakable , $Transparency ){
        $this->BlockType = $BlockType;
        $this->IsCraftable = $IsCraftable;
        $this->Texture = $Texture;
        $this->IsBreakable = $IsBreakable;
        $this->Transparency =$Transparency;
    }

    public function add() {
        global $pdo, $table;
        $sql = "INSERT INTO {$table} (BlockType,Texture ,IsCraftable, IsBreakable, Transparency) 
        VALUES (:BlockType,  :Texture,:IsCraftable, :IsBreakable, :Transparency)"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':BlockType' => $this->BlockType,
        ':Texture'=> $this->Texture,
        ':IsCraftable' => $this->IsCraftable,
        ':IsBreakable' => $this->IsBreakable,
        ':Transparency' => $this->Transparency));
        $stmt = $pdo->query("SELECT LAST_INSERT_ID()");  
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->BlockID = $row['LAST_INSERT_ID()'];
        return 0;
    }

    public function read() {
        global $pdo, $table;
        $sql = "SELECT * FROM {$table} WHERE BlockID = :BlockID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['BlockID' => $this->BlockID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function edit() {
        global $pdo, $table;
        $sql = "UPDATE {$table} SET BlockType = :BlockType, IsCraftable = :IsCraftable,
        IsBreakable = :IsBreakable, Transparency = :Transparency, Texture = :Texture
        WHERE BlockID = :BlockID";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['BlockID' => $this->BlockID,
        'BlockType' => $this->BlockType,
        'IsCraftable' => $this->IsCraftable,
        'IsBreakable' => $this->IsBreakable,
        'Transparency' => $this->Transparency,
        'Texture' => $this->Texture]);
    }    

   public function remove() {
        global $pdo, $table;
        $sql = "DELETE FROM {$table} WHERE BlockID = :BlockID";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['BlockID' => $this->BlockID]);
    }

    public static function view_all(){
        global $pdo, $table;
        $stmt = $pdo->query("SELECT * FROM {$table}");
        return $stmt;
    }


}