<?php
require_once "pdo.php";

$table = "player";

class Player{

    private $PlayerID = 0;
    private $Username;
    private $Status;
    private $XCoordinate = 0;
    private $YCoordinate = 0;
    private $ZCoordinate = 0;



    public function __construct($PlayerID,$Username, $Status ,$XCoordinate , $YCoordinate, $ZCoordinate){
        $this->PlayerID = $PlayerID;
        $this->Username = $Username;
        $this->Status = $Status;
        $this->XCoordinate = $XCoordinate;
        $this->YCoordinate = $YCoordinate;
        $this->ZCoordinate = $ZCoordinate;
    }

    public function add() {
        global $pdo, $table;
        $sql = "INSERT INTO {$table} (Username, Status, XCoordinate, YCoordinate, ZCoordinate) VALUES (:Username, :Status, :XCoordinate, :YCoordinate, :ZCoordinate)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['Username' => $this->Username, 'Status' => $this->Status, 'XCoordinate' => $this->XCoordinate, 'YCoordinate' => $this->YCoordinate, 'ZCoordinate' => $this->ZCoordinate]);
    }

    public function read() {
        global $pdo, $table;
        $sql = "SELECT * FROM {$table} WHERE PlayerID = :PlayerID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['PlayerID' => $this->PlayerID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function edit() {
        global $pdo, $table;
        $sql = "UPDATE {$table} SET Username = :Username, Status = :Status, XCoordinate = :XCoordinate, YCoordinate = :YCoordinate, ZCoordinate = :ZCoordinate WHERE PlayerID = :PlayerID";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['PlayerID' => $this->PlayerID, 'Username' => $this->Username, 'Status' => $this->Status, 'XCoordinate' => $this->XCoordinate, 'YCoordinate' => $this->YCoordinate, 'ZCoordinate' => $this->ZCoordinate]);
    }

   public function remove() {
        global $pdo, $table;
        $sql = "DELETE FROM {$table} WHERE PlayerID = :PlayerID";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['PlayerID' => $this->PlayerID]);
    }

    public static function view_all(){
        global $pdo, $table;
        $sql = "SELECT * FROM {$table}";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}