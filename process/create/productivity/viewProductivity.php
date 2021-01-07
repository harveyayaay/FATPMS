<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/productivity.php';

	$id = $_POST['emp_id'];
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
	date_default_timezone_set('Asia/Manila');
	$conn = new Database();

	$Prod = new Productivity($conn->databaseConnection());

	$count = 0;
	
	$task_list = $Prod->getTaskList($id, $date1, $date2);
	while($task_list_data = $task_list ->fetch( PDO::FETCH_ASSOC))
	{
		if($count === 0)
		{
			echo
				'<table class="table">
					<thead class=" text-primary">
			            <tr>
			              <td>Task List</td>
			              <td>Average Processing Time</td>  
			              <td>Volume</td>
			            </tr>
			        </thead>';
		}
		++$count;
		echo '<tr>';
			echo '<td>' . $task_list_data['task_type'] . '</td>';

			$task_avg = $Prod->getTaskAverageTime($id, $date1, $date2, $task_list_data['task_type']);
			$task_avg_data = $task_avg ->fetch( PDO::FETCH_ASSOC);
			echo '<td>' . $task_avg_data['average'] . '</td>';

			$task_vol = $Prod->countVolumeTaskType($id, $date1, $date2, $task_list_data['task_type']);
			$task_vol_data = $task_vol ->fetch( PDO::FETCH_ASSOC);
			echo '<td>' . $task_vol_data['count'] . '</td>';

			// $task_time = $Prod->getTaskEventTime($task_list_data['task_type']);
			// while($task_time_data = $task_time ->fetch( PDO::FETCH_ASSOC))
			// {

			// 	$time = explode(":", $task_time_data['task_duration']);

			// 	$hours = $hours + $time[0];
			// 	$minutes = $minutes + $time[1];
			// 	$seconds = $seconds + $time[2];
			// }

			// echo '<td>' .$hours . 'hr' . $minutes . 'mn' . $seconds . 'sc</td>';


			// if($seconds > 59)
			// 	{
			// 		$seconds = $seconds - 60;
			// 		++$minutes;
			// 	}

			// 	if($minutes > 59)
			// 	{
			// 		$minutes = $minutes - 60;
			// 		++$hours;
			// 	}

			// 	if($seconds < 10)
			// 	{
			// 		$seconds = '0'.$seconds;
			// 	}
			// 	if($minutes < 10)
			// 	{
			// 		$minutes = '0'.$minutes;
			// 	}
			// 	if($hours < 10)
			// 	{
			// 		$hours = '0'.$hours;
			// 	}

		echo '</tr>';
	}
	echo '</table>'

?>

