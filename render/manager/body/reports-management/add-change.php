<?php

  $title = $_POST['title'];
  $type = $_POST['type'];
  $goal = $_POST['goal'];
  $reference = $_POST['ref'];

  include '../../../../process/create/metric/addMetric.php'; 
  include 'change-landing-page.php'; 

?>