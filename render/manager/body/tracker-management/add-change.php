<?php

  $title = $_POST['title'];
  $ptime = $_POST['ptime'];
  $sla = $_POST['sla'];
  $level = $_POST['level'];

  include '../../../../process/create/task-list/addTaskList.php'; 
  include 'change-landing-page.php'; 

?>