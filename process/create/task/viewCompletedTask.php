<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task.php';
	include_once '../../../process/obj/task-list.php';

	$conn = new Database();
	date_default_timezone_set('Asia/Manila');

	$Task = new Task($conn->databaseConnection());
	$TaskList = new TaskList($conn->databaseConnection());

	$task_id = '';
	$emp_id = $_SESSION['employee_id'];

	$stmt = $Task->viewCompletedTask($emp_id);

	echo '<table class="table table-d	">
           	<thead class=" text-primary">
				<tr>
				  <th>Task Name</th>
				  <th>Client ID</th>	
				  <th>Date and Time Received</th>
				  <th>Start Time</th>
				  <th>End Time</th>
				  <th>Hold Duration</th>
				  <th>Process Duration</th>
			    </tr>
		    </thead>';

	while($data = $stmt->fetch( PDO::FETCH_ASSOC))
	{ 
		$task_id = $data['task_id']; 	

		$start_time = new DateTime($data['task_start_time']);
		$hold_start_time = new DateTime($data['task_hold_start_time']);
		$time1 = $start_time ->diff($hold_start_time);
		$str_time1 = $time1 ->format('%H:%I:%S');

		$hold_end_time = new DateTime($data['task_hold_end_time']);
		$end_time = new DateTime($data['task_end_time']);
		$time2 = $hold_end_time ->diff($end_time);
		$str_time2 = $time2 ->format('%H:%I:%S');

		$hold_start_time = new DateTime($data['task_hold_start_time']);
		$hold_end_time = new DateTime($data['task_hold_end_time']);
		$time3 = $hold_start_time ->diff($hold_end_time);
		$str_time3 = $time3 ->format('%H:%I:%S');
		
		// $a = new DateTime($return_processdiff);
		// $b = new DateTime($return_hold_processdiff);
		// $c = $b->diff($c);
		// $d = $c->format('%H:%I:%S');

		$_time1 = explode(":", $str_time1);
		$_time2 = explode(":", $str_time2);
		$_time3 = explode(":", $str_time3);

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

		$result_task = $TaskList->getTaskListData($data['task_type']);
		if($result_task_data = $result_task->fetch(PDO::FETCH_ASSOC))
		{
			$task_title = $result_task_data['task_list_title'];
		}
		echo
          ' <tr>
                <td>' . $task_title.'</td>
                <td>' . $data['task_client_id'].'</td>
                <td>' . $data['task_date_received']. '</td>
                <td>' . $data['task_start_time']. '</td>
                <td>' . $data['task_end_time']. '</td>

                <td>'.$_time3[0].'hr '.$_time3[1].'min '.$_time3[2].'sec</td>
                <td>'.$hours.'hr '.$minutes.'min '.$seconds.'sec</td>
            </tr>';

        $duration = $hours.':'.$minutes.':'.$seconds;
        $Task->task_duration = $duration;
		$Task->updateDuration($task_id);
    }
    echo '</table>';
?>