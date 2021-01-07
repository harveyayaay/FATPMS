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
		$j = 1;
		$result = $TaskList->getTaskList($level[$i]);
		while($result_data = $result->fetch(PDO::FETCH_ASSOC))
		{
			echo'
			<tr>
      	<td><input type="text" name="" value="'.$result_data['task_list_title'].'" disabled class="account-info-form text-edit"></td>
      	<td><input type="text" name="" value="'.$result_data['task_list_process_time'].'" disabled class="account-info-form text-edit"></td>
      	<td><input type="text" name="" value="'.$result_data['task_list_sla'].'" disabled class="account-info-form text-edit"></td>
      	<td><input type="text" name="" value="'.$result_data['task_list_importance'].'" disabled class="account-info-form text-edit"></td>
      	<td>
	  		<button class="btn-apply-m-sm" data-toggle="modal" data-target="#editModal" onclick="displayData('.$i.', '.$j.')">Edit</button>
      	</td>
		  </tr>';
		  ++$j;
		}
	}
?>



