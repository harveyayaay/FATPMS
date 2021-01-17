<?php
  $title = $_POST['a-task'];
  $caseno = $_POST['a-caseno'];
  $datetime = $_POST['a-datetime'];
  $tid = '';

  include '../../../../process/create/task-list/getProdUsingTitle.php'; 
  if($result_prod_data = $result_prod->fetch(PDO::FETCH_ASSOC))
  {
    $tid = $result_prod_data['task_list_id'];
  }
  include '../../../../process/create/task/addTask.php';
  header('Location: activity-monitoring.php');


?>