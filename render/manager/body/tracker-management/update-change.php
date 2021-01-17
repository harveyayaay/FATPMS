<?php
  $tid = $_POST['tid'];
  $title = $_POST['title'];
  $ptime = $_POST['ptime'];
  $sla = $_POST['sla'];
  $level = $_POST['level'];

  include '../../../../process/create/task-list/updateTaskListProd.php'; 
  include 'change-landing-page.php'; 
  
?>