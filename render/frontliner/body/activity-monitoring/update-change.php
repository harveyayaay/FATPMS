<?php
  $taskid = $_GET['taskid'];
  if($_GET['change'] == 'hold')
  {
    echo 'hold';
    include '../../../../process/create/task/holdTask.php'; 
    header('Location: activity-monitoring.php');
  }
  else if($_GET['change'] == 'continue')
  {
    echo 'continue';
    include '../../../../process/create/task/processTask.php'; 
    header('Location: activity-monitoring.php');
  }
  else
  {
    echo 'completed';
    include '../../../../process/create/task/completeTask.php'; 
    header('Location: activity-monitoring.php');
  }
?>