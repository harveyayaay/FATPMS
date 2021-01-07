<?php
	if($dt_start_time->format('H:i:s') >= $opener_emp_end[$i] && $dt_start_time->format('H:i:s') < $opener_emp_to[$i])
	{

		$get_start = $dt_start_time->format('H:i:s');
		$dt_get_start = new DateTime($get_start);
		$dt_get_start->modify('+12 hours');

		$Sched->schedule_time_from = $dt_get_start->format('H:i:s');

		$get_end = $dt_start_time->format('H:i:s');
		$dt_get_end = new DateTime($get_end);
		$dt_get_end->modify('+90 minutes');
		$dt_get_end->modify('+12 hours');

		$Sched->schedule_time_to = $dt_get_end->format('H:i:s');

		$Sched->schedule_task_list_id = 'P'.$primary;
		$Sched->insertSched();

		// echo 'P'.$primary;

		if($primary > 3)
			$primary = 1;
		else
			++$primary;
	}
	else if($dt_start_time->format('H:i:s') >= $closer_emp_from[0] && $dt_start_time->format('H:i:s') < $closer_emp_to[0])
	{	
		$get_start = $dt_start_time->format('H:i:s');
		$dt_get_start = new DateTime($get_start);
		$dt_get_start->modify('+12 hours');

		$Sched->schedule_time_from = $dt_get_start->format('H:i:s');

		$get_end = $dt_start_time->format('H:i:s');
		$dt_get_end = new DateTime($get_end);
		$dt_get_end->modify('+90 minutes');
		$dt_get_end->modify('+12 hours');

		$Sched->schedule_time_to = $dt_get_end->format('H:i:s');

		$Sched->schedule_task_list_id = 'S'.$secondary;

		// echo 'S'.$secondary;

		$Sched->insertSched();

		if($secondary > 3)
			$secondary = 1;
		else
			++$secondary;
	}
	else
	{
		$get_start = $dt_start_time->format('H:i:s');
		$dt_get_start = new DateTime($get_start);
		$dt_get_start->modify('+12 hours');

		$Sched->schedule_time_from = $dt_get_start->format('H:i:s');

		$get_end = $dt_start_time->format('H:i:s');
		$dt_get_end = new DateTime($get_end);
		$dt_get_end->modify('+90 minutes');
		$dt_get_end->modify('+12 hours');

		$Sched->schedule_time_to = $dt_get_end->format('H:i:s');

		$Sched->schedule_task_list_id = 'P'.$primary;
		$Sched->insertSched();

		$Sched->schedule_task_list_id = 'S'.$secondary;
		$Sched->insertSched();

		// echo 'P'.$primary;
		// echo 'S'.$secondary;

		if($primary > 3)
			$primary = 1;
		else
			++$primary;

		if($secondary > 3)
			$secondary = 1;
		else
			++$secondary;
	}
?>