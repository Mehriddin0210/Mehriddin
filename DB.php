<?php


class DB{
    public $pdo;
    public function __construct()
    {
    $dns = "mysql:host=127.0.0.1;dbname=work_of_tracker";
    $username = "root";
    $pasword = "root";

    $this->pdo = new PDO($dns, $username, $pasword);
    
    }
}