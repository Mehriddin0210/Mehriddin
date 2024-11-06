<?php
    
    
    require 'WorkDay.php';
    $workDay=new WorkDay();
    $db=new DB();
    $pdo=$db->pdo;

    

    if (isset($_POST['arrived_at']) and isset($_POST['leaved_at']) and isset($_POST['name'])) {
        if(!empty($_POST['name']) && !empty($_POST['arrived_at'] && !empty($_POST['leaved_at']))){

            $workDay->store($_POST['name'], $_POST['arrived_at'], $_POST['leaved_at']);
       
        }
    }

    $records = $workDay->getWorkDayList();
    require 'view.php';
?>
