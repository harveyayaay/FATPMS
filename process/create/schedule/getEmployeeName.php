<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';

	$conn = new Database();

	$Sched = new Schedule($conn->databaseConnection());

	$getAllId = $Sched->getAllEmployeeId();
	$datepicked = date( "Y-m-d", strtotime( $date. " +0day"));

	while($getAllId_data = $getAllId ->fetch( PDO::FETCH_ASSOC))
	{

		$id = $getAllId_data['employee_id'];
		$fname = $getAllId_data['employee_fname'];
		$lname = $getAllId_data['employee_lname'];
		echo'
		<tr>
		  <td rowspan="2"><a href="add-schedule.php?date='.$datepicked.'&id='.$id.'">'.$lname.', '.$fname.'</a></td>';

		$schedulingId = $Sched->getSchedulingTableId($id, $datepicked);
		if($schedulingId_data = $schedulingId ->fetch( PDO::FETCH_ASSOC))
		{
			$scheduling_id = $schedulingId_data['scheduling_id'];	

			include 'getPrimary.php';echo'</tr>';
			include 'getSecondary.php';
			
			echo'<tr>';
		}
		else
		{
			echo '<td style="color: black;" colspan="15" rowspan="2">No Schedule Available <b> (Click the Frontliners Name to Add Schedule)<b></td>';
			echo'</tr><td></td>';
		}

		
	}
?>

