<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';

	$conn = new Database();
	date_default_timezone_set('Asia/Manila');

	$Sched = new Schedule($conn->databaseConnection());

	if(isset($_POST['add-schedule']))
	{
		$empid = $_POST['empid'];
		$date = $_POST['date'];

		$tasktype[0] = $_POST['tasktype0'];
		$tasktype[1] = $_POST['tasktype1'];
		$tasktype[2] = $_POST['tasktype2'];
		$tasktype[3] = $_POST['tasktype3'];
		$tasktype[4] = $_POST['tasktype4'];
		$tasktype[5] = $_POST['tasktype5'];
		$tasktype[6] = $_POST['tasktype6'];
		$tasktype[7] = $_POST['tasktype7'];

		$from[0] = $_POST['fromtime0'];
		$from[1] = $_POST['fromtime1'];
		$from[2] = $_POST['fromtime2'];
		$from[3] = $_POST['fromtime3'];
		$from[4] = $_POST['fromtime4'];
		$from[5] = $_POST['fromtime5'];
		$from[6] = $_POST['fromtime6'];
		$from[7] = $_POST['fromtime7'];

		$to[0] = $_POST['totime4'];
		$to[1] = $_POST['totime1'];
		$to[2] = $_POST['totime2'];
		$to[3] = $_POST['totime3'];
		$to[4] = $_POST['totime4'];
		$to[5] = $_POST['totime5'];
		$to[6] = $_POST['totime6'];
		$to[7] = $_POST['totime7'];

		$quantity[0] = $_POST['quantity0'];
		$quantity[1] = $_POST['quantity1'];
		$quantity[2] = $_POST['quantity2'];
		$quantity[3] = $_POST['quantity3'];
		$quantity[4] = $_POST['quantity4'];
		$quantity[5] = $_POST['quantity5'];
		$quantity[6] = $_POST['quantity6'];
		$quantity[7] = $_POST['quantity7'];
	}		

	

	$Sched->scheduling_emp_id = $empid;
	$Sched->scheduling_date = $date;

	if($result = $Sched->insertDataInScheduling())
	{
			$scheduling_id = $Sched->getSchedulingId($empid, $date);
			$scheduling_id_data = $scheduling_id->fetch( PDO::FETCH_ASSOC);
			$sched_id =	$scheduling_id_data['scheduling_id'];

			$Sched->schedule_id = $sched_id;

			$counter = 0;

			while($counter < 8)
			{
				$Sched->schedule_task_type = $tasktype[$counter];
				$Sched->schedule_time_from = $from[$counter];
				$Sched->schedule_time_to = $to[$counter];
				$Sched->schedule_quantity = $quantity[$counter];
				if($counter < 4)
				{
					$Sched->schedule_importance = 'Primary';
				}
				else
				{
					$Sched->schedule_importance = 'Secondary';
				}
				++$counter;
				$Sched->insertSched();
			}

			

	}
	
	header('location: ../../../render/supervisor/body/scheduling.php');

?>

