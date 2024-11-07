<?php
require 'DB.php';


class WorkDay{
    const WORK_TIME = 8;

    public $pdo;

    public function __construct(){
        $db=new DB();
        $this->pdo=$db->pdo;
    }

    public function store(
        string $name,
        string $arrived_at,
        string $leaved_at
    

    ){
        $arrived_at = new DateTime($arrived_at);
        $leaved_at = new DateTime($leaved_at);
        
        $diff= $arrived_at->diff($leaved_at);
        $hour=$diff->h;
        $minute=$diff->i;
        $second=$diff->s;
        $total = ((self::WORK_TIME*3600) - ($hour*3600)-($minute*60));

        $query = "INSERT INTO work_time (name, arrived_at, leaved_at, required_of) VALUES (:name, :arrived_at, :leaved_at, :required_of)";
    
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindValue(':arrived_at', $arrived_at->format(format: 'Y-m-d H:i'));
        $stmt->bindValue(':leaved_at', $leaved_at->format(format: 'Y-m-d H:i'));
        $stmt->bindParam(':required_of', $total);
        $stmt->execute();
        header('Location: work_daily.php');
        return;
    
    
    }
    public function getWorkDayList(){
        $query="Select * from work_time";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }

    public function calculateDebtTime(){
        $selectQuery= "select name, sum(required_of) as 'debt' from daily group by name;";
        $stmt = $this->pdo->prepare($selectQuery);
        return $stmt->fetchAll();
    }
    public function markAsDone(int $id): void{
        $query="UPDATE work_time SET required_of=0 Where id= :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        header('Location: work_daily.php');
    }
}