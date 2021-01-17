<?php
  include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task.php';

	$conn = new Database();

  $Task = new Task($conn->databaseConnection());
  
  $result_ongoing = $Task->checkActivityOngoingCurrent($id);
?>

