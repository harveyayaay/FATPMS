<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task.php';

	$conn = new Database();

	$Task = new Task($conn->databaseConnection());
	date_default_timezone_set('Asia/Manila');

	$count = 0;
	$task_id = '';
	$emp_id = $_SESSION['employee_id'];

	$stmt = $Task->viewOnholdTask($emp_id);

	echo
		'<table class="table">
          <thead class=" text-primary">
		      <tr>
				<th>Task Name</th>
				<th>Client ID</th>	
				<th>Date and Time Received</th>
				<th>Start Time</th>
				<th>Action</th>
			  </tr>
		  </thead>';
	
	while($data = $stmt->fetch( PDO::FETCH_ASSOC))
	{ 
		$task_id = $data['task_id']; 
		$start_time = $data['task_start_time'];
		$tid = $data['task_type'];
		include '../../../process/create/task-list/getSpecificTaskType.php';
		echo
          '<tr>
            <td>' . $task_title.'</td>
            <td>' . $data['task_client_id'].'</td>
            <td>' . $data['task_date_received']. '</td>
            <td>' . $data['task_start_time']. '</td>
            <td>
				<a href="../../../process/create/task/processTask.php?id='.$task_id.'"><button class="form-button">Continue Task</button></a>
		  	</td>
          </tr>';
    }

    echo '</table>'
?>	