<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task.php';

	$conn = new Database();
	date_default_timezone_set('Asia/Manila');

	$Task = new Task($conn->databaseConnection());

	$count = 0;
	$task_id = '';

	if(!($stmt = $Task->viewOngoingTask()))
	{
		// echo 'Failed viewing data';
	}
	else
	{
		while($data = $stmt->fetch( PDO::FETCH_ASSOC))
		{ 
			$task_id = $data['task_id']; 
			$tid = $data['task_type'];
			include '../../../process/create/task-list/getSpecificTaskType.php';
			echo
              '<tr>
                  <td>' . $task_title.'</td>
                  <td>' . $data['task_client_id'].'</td>
                  <td>' . $data['task_date_received']. '</td>	
                  <td>' . $data['task_start_time']. '</td>
                  <td>	
					<a href="../../../process/create/task-sv/holdTask.php?id='.$task_id.'"><button class="form-link-s">Hold</button></a>
					<a href="../../../process/create/task-sv/completeTask.php?id='.$task_id.'"><button class="form-link-s">Complete</button></a>
				  </td>
                </tr>';
        }
	}
?>
					<!-- <a href="holdTask.php"><button class="btn btn-primary mb-2 btn-lg" >Hold</button></a> -->
