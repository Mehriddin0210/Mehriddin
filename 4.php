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
    define('WORK_TIME',8);
    if(isset($_GET['arrived_at']) and isset($_GET['leaved_at'])){
        $arrived_at = new DateTime(($_GET['arrived_at']));
        $leaved_at = new DateTime(($_GET['leaved_at']));
        $diff=$arrived_at->diff(($leaved_at));

        echo "
        <h1>Arrived at " . $_GET['arrived_at'] . "</h1>
        <h1>Leaved at . {$_GET['leaved_at']}</h1>
        <h1>Leaved at " . WORK_TIME . "</h1>
        <h1>Diff Hour: $diff->h </h1>
        <h1> Diff Hour: $diff->i </h1>
        ";
    }
    ?>
</body>
</html>