<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/employee.php';
	include_once '../../../process/obj/task.php';
	include_once '../../../process/obj/task-list.php';
	include_once '../../../process/obj/settings.php';

	$conn = new Database();

	$Employee = new Employee($conn->databaseConnection());
	$Task = new Task($conn->databaseConnection());
	$TaskList = new TaskList($conn->databaseConnection());
	$Settings = new Settings($conn->databaseConnection());

	$dateto = date('Y-m');
	$datefrom = date('Y-m-d', strtotime($dateto));
	$dateto = date('Y-m-d');

	$result_qa = $Settings->getQA();
	if($result_qa_data = $result_qa->fetch(PDO::FETCH_ASSOC))
	{
		$qa_set = $result_qa_data['settings_set'];
	}

	$result_esc = $Settings->getESC();
	if($result_esc_data = $result_esc->fetch(PDO::FETCH_ASSOC))
	{
		$esc_set = $result_esc_data['settings_set'];
	}
	$countID = 0;

	$result_emp = $Employee->getAllFrontliner();
	while($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
	{
		echo '<tr>';
		echo '<td class="dash-td">'.$result_emp_data['employee_fname'].' '.$result_emp_data['employee_lname'].'</td>';

		// count individual
				$result_task = $Task->countIndividualVolume($result_emp_data['employee_id'], $datefrom, $dateto);
		if($result_task_data = $result_task->fetch(PDO::FETCH_ASSOC))
		{
			echo '<td  class="dash-td" id="id'.$countID.'">'.$result_task_data['countvol'].'</td>';
			++$countID;
		}

		// get task title
		$result_task_id = $TaskList->getTaskId('Application');
		while($result_task_id_data = $result_task_id->fetch(PDO::FETCH_ASSOC))
		{
			$a_count = 0;
			$a_seconds = 0;
			$duration_app = '00:00:00';
			// average processing time of application
			$result_app = $Task->getProcessingTimeApplication($result_emp_data['employee_id'], $result_task_id_data['task_list_id'], $datefrom, $dateto);
			while($result_app_data = $result_app->fetch(PDO::FETCH_ASSOC))
			{
				$h = date('H', strtotime($result_app_data['task_duration']));
				$m = date('i', strtotime($result_app_data['task_duration']));
				$s = date('s', strtotime($result_app_data['task_duration']));

				$duration_app = date('H:i:s', strtotime("+".$h." hours +".$m." minutes +".$s." seconds", strtotime($duration_app)));
				$a_seconds += $h * 3600;
				$a_seconds += $m * 60;
				$a_seconds += $s;
				// echo '<br>';
				++$a_count;

				// echo $result_emp_data['employee_id'].' '.$result_app_data['task_duration'].'<br>';
				// echo '<td></td>';
			}
			if($a_count > 0)
			$a_seconds /= $a_count;

			echo '<td class="dash-td">'.gmdate('H:i:s', $a_seconds).'</td>';
		}

		// get task title
		$result_task_id = $TaskList->getTaskId('Urgent');
		while($result_task_id_data = $result_task_id->fetch(PDO::FETCH_ASSOC))
		{
			$a_count = 0;
			$a_seconds = 0;
			$duration_app = '00:00:00';
			// average processing time of application
			$result_app = $Task->getProcessingTimeApplication($result_emp_data['employee_id'], $result_task_id_data['task_list_id'], $datefrom, $dateto);
			while($result_app_data = $result_app->fetch(PDO::FETCH_ASSOC))
			{
				$h = date('H', strtotime($result_app_data['task_duration']));
				$m = date('i', strtotime($result_app_data['task_duration']));
				$s = date('s', strtotime($result_app_data['task_duration']));

				$duration_app = date('H:i:s', strtotime("+".$h." hours +".$m." minutes +".$s." seconds", strtotime($duration_app)));
				$a_seconds += $h * 3600;
				$a_seconds += $m * 60;
				$a_seconds += $s;
				// echo '<br>';
				++$a_count;

				// echo $result_emp_data['employee_id'].' '.$result_app_data['task_duration'].'<br>';
				// echo '<td></td>';
			}
			if($a_count > 0)
			$a_seconds /= $a_count;

			echo '<td class="dash-td">'.gmdate('H:i:s', $a_seconds).'</td>';
		}


		echo '</tr>';
	}

?>

<script type="text/javascript">
	function changeTotal()
	{
		var qa = document.getElementById('qa');
		var esc = document.getElementById('esc');

		x = parseInt(qa.value);
		y = parseInt(esc.value);

		sum = x + y

		if(sum == NaN)
			document.getElementById('total').value = 0;
		else
			document.getElementById('total').value = sum;
		
	}
</script>