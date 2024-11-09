<?php
require 'DB.php';

class WorkDay {
    const WORK_TIME = 8;

    public $pdo;

    public function __construct() {
        $db = new DB();
        $this->pdo = $db->pdo;
    }

    public function store(string $name, string $arrived_at, string $leaved_at) {
        $arrived_at = new DateTime($arrived_at);
        $leaved_at = new DateTime($leaved_at);

        $diff = $arrived_at->diff($leaved_at);
        $hour = $diff->h;
        $minute = $diff->i;
        $total = ((self::WORK_TIME * 3600) - ($hour * 3600) - ($minute * 60));

        $query = "INSERT INTO work_time (name, arrived_at, leaved_at, required_of) VALUES (:name, :arrived_at, :leaved_at, :required_of)";
    
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindValue(':arrived_at', $arrived_at->format('Y-m-d H:i'));
        $stmt->bindValue(':leaved_at', $leaved_at->format('Y-m-d H:i')); 
        $stmt->bindParam(':required_of', $total);
        $stmt->execute();

        header('Location: work_daily.php');
        return;
    }

    public function getWorkDayList() {
        $query = "SELECT * FROM work_time ORDER BY arrived_at DESC";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateDebtTime() {
        $selectQuery = "SELECT name, SUM(required_of) AS debt FROM work_time GROUP BY name";
        $stmt = $this->pdo->prepare($selectQuery);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function markAsDone(int $id): void {
        $query = "UPDATE work_time SET required_of = 0 WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id); 
        $stmt->execute();
        header('Location: work_daily.php');
    }

    public function getWorkDayListWithPagination(int $offset) {
        $offset = $offset > 0 ? ($offset - 1) * 10 : 0; 
        $query = "SELECT * FROM work_time ORDER BY arrived_at DESC LIMIT 10 OFFSET :offset"; 
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalRecords() {
        $query = "SELECT COUNT(id) AS pageCount FROM work_time";
        $stmt = $this->pdo->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function calculatePageCount() {
        $total = $this->getTotalRecords()['pageCount'];
        return ceil($total / 10);
    }
}
