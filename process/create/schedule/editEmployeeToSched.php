<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';

	$conn = new Database();

	$Sched = new Schedule($conn->databaseConnection());

	$result = $Sched->getAllIdOfSameDate($_POST['date']);	
	while($result_data = $result->fetch(PDO::FETCH_ASSOC))
	{
		$result1 = $Sched->getIdOfTimeFrom($result_data['scheduling_id'], $_POST['taskid'], $_POST['timefrom']);
		while($result_data1 = $result1->fetch(PDO::FETCH_ASSOC))
		{
			$result2 = $Sched->getSchedulingEmpId($_POST['schedid']);
			if($result_data2 = $result2->fetch(PDO::FETCH_ASSOC))
			{
				$result3 = $Sched->editEmployeeToSched($_POST['schedid'], $result_data1['schedule_id'], $_POST['taskid'], $_POST['timefrom'], $_POST['timeto']);
			}
		}
	}





?>