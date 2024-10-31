<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
        <input type="datetime-local" name="arrived_at"><br>
        <input type="datetime-local" name="leaved_at"><br>
        <button>Yuborish</button>
    </form>
    <?php
    
    $dns="mysql:host=127.0.0.1;dbname=work_of_tracker";
    $username="root";
    $pasword="root";


    $pdo= new PDO($dns, $username, $pasword);

    $workTimes=$pdo->query(query: "SELECT * from work_time");

    print_r($workTimes->fetch());


    
    
    
    define('WORK_TIME',8);
    if(isset($_GET['arrived_at']) and isset($_GET['leaved_at'])){
        $arrived_at =$_GET['arrived_at'];
        $leaved_at =$_GET['leaved_at'];
        //$diff=$arrived_at->diff(($leaved_at));
        $query = "INSERT into work_time(arrived_at, leaved_at) VALUES(:arrived_at, :leaved_at)";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam
};
    
    ?>
</body>
</html>