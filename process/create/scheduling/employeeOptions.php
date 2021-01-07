<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';
	include_once '../../../process/obj/task-list.php';

	$conn = new Database();
	date_default_timezone_set('Asia/Manila');

	$Sched = new Schedule($conn->databaseConnection());
	$TaskList = new TaskList($conn->databaseConnection());
	

	$Y = $_POST['Y'];
	$m = $_POST['m'];
	$d = $_POST['d'];
	$H = $_POST['H'];
	$i = $_POST['i'];
	$s = $_POST['s'];
	$type = $_POST['type'];
	$kind = $_POST['kind'];

	if($type == 1)
		$taskid = 'P'.$_POST['num'];
	else
		$taskid = 'S'.$_POST['num'];

	

	$datepicked = $Y.'-'.$m.'-'.$d;	
	$date = date( "Y-m-d", strtotime( $datepicked));

	$timepicked = $H.':'.$i.':'.$s;
	$time = date( "H:i:s", strtotime( $timepicked));

	$td_time = new DateTime($time);
	$td_time->modify('+90 minutes');

	$result_task = $TaskList->getTaskListData($taskid);
	$result_task_data = $result_task->fetch(PDO::FETCH_ASSOC);

	$count = 0;

	$result = $Sched->getAllEmployeeInDateSched($date);
	while($result_data = $result->fetch(PDO::FETCH_ASSOC))
	{
		$emp_id[$count] = $result_data['scheduling_emp_id'];
		$sched_id[$count] = $result_data['scheduling_id'];
		++$count;
	}

	if($kind == 0)
	{
		echo '<p class="card-title">Add Frontliner in '.$result_task_data['task_list_title'].'</p>';
		echo '<table>';
		for($j=0;$j<$count;$j++)
		{
			$result1 = $Sched->getAllEmployeeInTimeSched($time, $sched_id[$j]);
			while($result_data1 = $result1->fetch(PDO::FETCH_ASSOC))
			{
				$result = $Sched->getEmployeeName($emp_id[$j]);
				if($result_data = $result->fetch(PDO::FETCH_ASSOC))
				{
					echo '<input type="text" name="taskid" value="'.$taskid.'" hidden>';
					echo '<input type="text" name="timefrom" value="'.$time.'" hidden>';
					echo '<input type="text" name="timeto" value="'.$td_time->format('H:i:s').'" hidden>';
					echo '<tr>';
					echo '<td><input type="radio" name="schedid" value="'.$sched_id[$j].'"></td>';
					echo '<td>'.$result_data['employee_lname'].', '.$result_data['employee_fname'].'</td>';
					echo '</tr>';
				}
			}
		}	
		echo '<table>';
	}
	else
	{
		echo '<p class="card-title">Edit Frontliner in '.$result_task_data['task_list_title'].'</p>';
		echo '<table>';
		for($j=0;$j<$count;$j++)
		{
			$result1 = $Sched->getAllEmployeeInTimeSched($time, $sched_id[$j]);
			while($result_data1 = $result1->fetch(PDO::FETCH_ASSOC))
			{
				$result = $Sched->getEmployeeName($emp_id[$j]);
				if($result_data = $result->fetch(PDO::FETCH_ASSOC))
				{
					echo '<input type="text" name="taskid" value="'.$taskid.'" hidden>';
					echo '<input type="text" name="date" value="'.$date.'" hidden>';
					echo '<input type="text" name="timefrom" value="'.$time.'" hidden>';
					echo '<input type="text" name="timeto" value="'.$td_time->format('H:i:s').'" hidden>';
					echo '<tr>';
					echo '<td><input type="radio" name="schedid" value="'.$sched_id[$j].'"></td>';
					echo '<td>'.$result_data['employee_lname'].', '.$result_data['employee_fname'].'</td>';
					echo '</tr>';
				}
			}
		}
		echo '<table>';
	}
	


?>
