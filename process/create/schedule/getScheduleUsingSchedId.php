<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';

	$conn = new Database();

	$Sched = new Schedule($conn->databaseConnection());
	$result_schedule = $Sched->getScheduleUsingSchedId($scheduling_id);
?>