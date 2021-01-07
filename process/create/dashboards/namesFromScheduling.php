<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/employee.php';
	include_once '../../../process/obj/schedule.php';
	include_once '../../../process/obj/task.php';
	include_once '../../../process/obj/task-list.php';

	$conn = new Database();

	$Employee = new Employee($conn->databaseConnection());
	$Schedule= new Schedule($conn->databaseConnection());
	$Task = new Task($conn->databaseConnection());
	$TaskList = new TaskList($conn->databaseConnection());

	date_default_timezone_set('Asia/Manila');
	$date = date('Y-m-d');

	$count_prod = 0;
	$result_list = $TaskList->getAllProd();
	while($result_list_data = $result_list->fetch(PDO::FETCH_ASSOC))
	{
		$prod[$count_prod] = $result_list_data['task_list_id'];
		++$count_prod;
	}

	$count_nonprod = 0;
	$result_list = $TaskList->getAllNonProd();
	while($result_list_data = $result_list->fetch(PDO::FETCH_ASSOC))
	{
		$nonprod[$count_nonprod] = $result_list_data['task_list_id'];
		++$count_nonprod;
	}

	// getting id of employees that has schedule today
	$result_sched = $Schedule->getIdOfScheduledToday($date);	
	while($result_sched_data = $result_sched->fetch(PDO::FETCH_ASSOC))
	{
		echo '<tr>';
		echo '<td>'.$result_sched_data['scheduling_emp_id'].'</td>';

		$p_count = 0;
		$p_seconds = 0;
		$duration_prod = '00:00:00';
		for($i=0;$i<$count_prod;++$i)
		{
			$result_duration = $Task->getProdDuration($date, $prod[$i], $result_sched_data['scheduling_emp_id']);
			while($result_duration_data = $result_duration->fetch(PDO::FETCH_ASSOC))
			{
				$h = date('H', strtotime($result_duration_data['task_duration']));
				$m = date('i', strtotime($result_duration_data['task_duration']));
				$s = date('s', strtotime($result_duration_data['task_duration']));
				// echo $result_duration_data['task_duration'].' ';
				$duration_prod = date('H:i:s', strtotime("+".$h." hours +".$m." minutes +".$s." seconds", strtotime($duration_prod)));
				$p_seconds += $h * 3600;
				$p_seconds += $m * 60;
				$p_seconds += $s;
				// echo '<br>';
				++$p_count;
			}
			
		}	
		if($p_count > 0)
			$p_seconds /= $p_count;

		echo '<td>'.gmdate('H:i:s', $p_seconds).'</td>';

		$n_count = 0;
		$n_seconds = 0;
		$duration_nonprod = '00:00:00';
		for($i=0;$i<$count_nonprod;++$i)
		{
			$result_duration = $Task->getProdDuration($date, $nonprod[$i], $result_sched_data['scheduling_emp_id']);
			while($result_duration_data = $result_duration->fetch(PDO::FETCH_ASSOC))
			{
				$h = date('H', strtotime($result_duration_data['task_duration']));
				$m = date('i', strtotime($result_duration_data['task_duration']));
				$s = date('s', strtotime($result_duration_data['task_duration']));
				// echo $result_duration_data['task_duration'].' ';
				$duration_nonprod = date('H:i:s', strtotime("+".$h." hours +".$m." minutes +".$s." seconds", strtotime($duration_nonprod)));
				$n_seconds += $h * 3600;
				$n_seconds += $m * 60;
				$n_seconds += $s;
				// echo '<br>';
				++$n_count;
			}
		}	
		if($n_count > 0)
			$n_seconds /= $n_count;

		echo '<td>'.gmdate('H:i:s', $n_seconds).'</td>';

		echo '</tr>';
	}


?>