<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task.php';
	include_once '../../../process/obj/employee.php';
	include_once '../../../process/obj/datetime.php';
	include_once '../../../process/obj/task-list.php';

	$conn = new Database();

	$Task = new Task($conn->databaseConnection());
	$Employee = new Employee($conn->databaseConnection());
	$DateTimeClass = new DateTimeClass($conn->databaseConnection());
	$TaskList = new TaskList($conn->databaseConnection());

	$result = $Task->viewCompletedTaskSV();
	while($result_data = $result->fetch(PDO::FETCH_ASSOC))
	{
		$result1 = $Employee->getEmployee($result_data['task_employee_id']);
		if($result_data1 = $result1->fetch(PDO::FETCH_ASSOC))
		{
			$result2 = $TaskList->getTaskListProcessingTime($result_data['task_type']);
			if($result_data2 = $result2->fetch(PDO::FETCH_ASSOC))
			{
				$result3 = $DateTimeClass->getTimeDiff($result_data2['task_list_process_time'], $result_data['task_duration']);
				$result_data3 = $result3->fetch(PDO::FETCH_ASSOC);

				
				echo'
				<tr>
					<td>'.$result_data1['employee_fname'].' '.$result_data1['employee_lname'].'</td>
					<td>'.$result_data['task_type'].'</td>';

					if($result_data3['time_diff'] < '00:00:00')
					{
						echo '
							<td>'.$result_data['task_duration'].'</td>
							<td><i style="color: #dc3545;">!</i></td>';
					}
					else
					{
						echo '
							<td>'.$result_data['task_duration'].'</td>
							<td><i class="now-ui-icons ui-1_check" style="color: #17a2b8;"></i></td>';
					}

				echo'</tr>';
			}
		}
	}
?>
