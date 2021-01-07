<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task-list.php';

	$conn = new Database();
	date_default_timezone_set('Asia/Manila');

	$TaskList = new TaskList($conn->databaseConnection());

	$level[0] = 'Primary';
	$level[1] = 'Secondary';
	$level[2] = 'Non-Productive';

	for($i=0; $i<3; $i++)
	{
		$result = $TaskList->getTaskList($level[$i]);
		while($result_data = $result->fetch(PDO::FETCH_ASSOC))
		{
			echo'<td class="table-dark">'.$result_data['task_list_title'].'</td>';
		}
	}
   echo '</select>';                
       
?>



