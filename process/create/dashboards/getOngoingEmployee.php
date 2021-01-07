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

	$ongoing_task_found = false;
	$count = 0;

	$result = $Task->viewOngoingTask();
	while($result_data = $result->fetch(PDO::FETCH_ASSOC))
	{
		if($ongoing_task_found === false)
		{
			echo '
			<table class="table" id=here>
		        <tr>
		          <td>Employee Name</td>
		          <td>Activity</td>
		          <td>Duration</td>
		          <td>Status</td>
		        </tr>';
		}

		$result1 = $Employee->getEmployee($result_data['task_employee_id']);
		if($result_data1 = $result1->fetch(PDO::FETCH_ASSOC))
		{
			
				$result4 = $DateTimeClass->getTimeDiff($result_data['task_hold_start_time'], $result_data['task_start_time']);
				$result_data4 = $result4->fetch(PDO::FETCH_ASSOC);

				$result5 = $DateTimeClass->getTimeDiff(date('H:i:s'), $result_data['task_hold_end_time']);
				$result_data5 = $result5->fetch(PDO::FETCH_ASSOC);

				$_time1 = explode(":", $result_data4['time_diff']);
				$_time2 = explode(":", $result_data5['time_diff']);

				$seconds = $_time1[2] + $_time2[2];
				$minutes = $_time1[1] + $_time2[1] ;
				$hours = $_time1[0] + $_time2[0];

				if($seconds > 59)
				{
					$seconds = $seconds - 60;
					++$minutes;
				}

				if($minutes > 59)
				{
					$minutes = $minutes - 60;
					++$hours;
				}

				if($seconds < 10)
				{
					$seconds = '0'.$seconds;
				}
				if($minutes < 10)
				{
					$minutes = '0'.$minutes;
				}
				if($hours < 10)
				{
					$hours = '0'.$hours;
				}

				$duration = $hours.':'.$minutes.':'.$seconds;

				$result2 = $TaskList->getTaskListProcessingTime($result_data['task_type']);
				$result_data2 = $result2->fetch(PDO::FETCH_ASSOC);
				
				$tid = $result_data['task_type'];
				$result_list = $TaskList->getTaskListData($tid);
				if($result_list_data = $result_list->fetch(PDO::FETCH_ASSOC))
				{
					$task_title = $result_list_data['task_list_title'];
					$task_process_time = $result_list_data['task_list_process_time'];
					$task_sla = $result_list_data['task_list_sla'];
					$task_importance = $result_list_data['task_list_importance'];
				}

				echo'
				<tr>
					<td>'.$result_data1['employee_fname'].' '.$result_data1['employee_lname'].'</td>
					<td>'.$task_title.'</td>
					<td>'.$result_data2['task_list_process_time'].'</td>';
				if($duration > $result_data2['task_list_process_time'])
				{
					echo '
						<td>'.$duration.'</td>
						<td><i style="color: #dc3545;">!</i></td>';
				}
				else
				{
					echo '
						<td>'.$duration.'</td>
						<td><i class="now-ui-icons ui-1_check" style="color: #17a2b8;"></i></td>';
				}
				echo'</tr>';
				++$count;
		}
		
		$ongoing_task_found = true;
	}
			echo '</table>';

	if($ongoing_task_found == false)
	{
		echo '<div class="ongoingnotfound">No Ongoing Task Available</div>';
	}
?>

<style type="text/css">
	.ongoingnotfound
	{
		margin-top: 30%;
		display: flex;
		justify-content: center;
		height: 100px;
	}
</style>

<script type="text/javascript">
  function waitAndshow() 
  {
  	$( "#here" ).load(window.location.href + " #here" );
	}
  setInterval(waitAndshow, 1000);

</script>

