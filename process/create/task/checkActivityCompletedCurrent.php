<?php
  include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task.php';

	$conn = new Database();

  $Task = new Task($conn->databaseConnection());
  
  $result_completed = $Task->checkActivityCompletedCurrent($id);
?>

