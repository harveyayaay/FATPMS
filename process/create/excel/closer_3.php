<?php
	$n = $primary + (3 - $row);
	while($n > 4)
	{
		$n = $n - 4;
	}
	$missing = $n;
	$location = 5 - $missing;
	if($dt_start_time->format('H:i:s') >= $closer_emp_from[$i] && $dt_start_time->format('H:i:s') < $opener_emp_end[0])
	{
		if($location === $primary)
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
			
			$Sched->schedule_task_list_id = 'P'.$missing;
			$Sched->insertSched();

			if($primary > 3)
				$primary = 1;
			else
				++$primary;
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
			
			if($primary > 3)
				$primary = 1;
			else
				++$primary;
		}
		
	}
	else if($dt_start_time->format('H:i:s') >= $opener_emp_end[0] && $dt_start_time->format('H:i:s') < $opener_emp_to[0])
	{	
		$n = $secondary + (3 - $row);
		while($n > 4)
		{
			$n = $n - 4;
		}
		$missing = $n;

		if($missing > 1)
		{
			if($missing > 2)
			{
				if($missing > 3)
				{
					$s_location = $missing - 1;
				}
				else
				{
					$s_location = $missing - 2;
				}
			}
			else
			{
				$s_location = $missing + 2;
			}
		}
		else
		{
			$s_location = $missing + 1;
		}

		if($s_location === $secondary)
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
			$Sched->insertSched();
			
			$Sched->schedule_task_list_id = 'S'.$missing;
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

			$Sched->schedule_task_list_id = 'S'.$secondary;
			$Sched->insertSched();

			if($secondary > 3)
				$secondary = 1;
			else
				++$secondary;
		}
		
	}
	else
	{
		if($missing > 1)
		{
			if($missing > 2)
			{
				if($missing > 3)
				{
					$s_location = $missing - 1;
				}
				else
				{
					$s_location = $missing - 2;
				}
			}
			else
			{
				$s_location = $missing + 2;
			}
		}
		else
		{
			$s_location = $missing + 1;
		}
		if($location === $primary)
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
			
			$Sched->schedule_task_list_id = 'P'.$missing;
			$Sched->insertSched();

			if($primary > 3)
				$primary = 1;
			else
				++$primary;

			if($secondary > 3)
				$secondary = 1;
			else
				++$secondary;
		}
		else if($s_location === $secondary)
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

			$Sched->schedule_task_list_id = 'S'.$missing;
			$Sched->insertSched();

			if($primary > 3)
				$primary = 1;
			else
				++$primary;

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
			
			if($primary > 3)
				$primary = 1;
			else
				++$primary;

			if($secondary > 3)
				$secondary = 1;
			else
				++$secondary;
		}
	}
?>