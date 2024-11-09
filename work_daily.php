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
    $currentPage = isset($_GET['page'])  ? $_GET['page'] : 0;
    $records = $workDay->getWorkDayListWithPagination($currentPage);
    
    $debt = $workDay->calculateDebtTime();
    if (isset($_GET['done']) and isset($_GET['done'])) { 
        $workDay->markAsDone($_GET['done']);
    }        
    
    
    require 'view.php';
?>



