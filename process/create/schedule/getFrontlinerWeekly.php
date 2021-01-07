<?php


	for($days=0; $days < 5; $days++)
	{
		$tasks = 0;
		$scheduleInfo = $Sched->getSchedule($sched_date[1][$days], 'Primary');
	
		while($scheduleInfo_data = $scheduleInfo ->fetch( PDO::FETCH_ASSOC))
		{
			$sched_table[$days][$tasks][0] = $scheduleInfo_data['schedule_task_type'];
			$sched_table[$days][$tasks][1] = $scheduleInfo_data['schedule_time_from'];
			$sched_table[$days][$tasks][2] = $scheduleInfo_data['schedule_time_to'];

			$sched_table[$days][$tasks][1] = date( "H:i:s", strtotime( $sched_table[$days][$tasks][1]. " +0day"));
			$sched_table[$days][$tasks][2] = date( "H:i:s", strtotime( $sched_table[$days][$tasks][2]. " +0day"));

			$from_time = new DateTime($sched_table[$days][$tasks][1]);
			$to_time = new DateTime($sched_table[$days][$tasks][2]);

			$from_time->modify('-12 hours');
			$to_time->modify('-12 hours');

			$sched_table[$days][$tasks][1] = $from_time->format('H:i:s');
			$sched_table[$days][$tasks][2] = $to_time->format('H:i:s');
	
			++$tasks;
		}
	}

	for($days=5; $days < 10; $days++)
	{
		$tasks = 0;
		$scheduleInfo = $Sched->getSchedule($sched_date[1][$days-5], 'Secondary');
	
		while($scheduleInfo_data = $scheduleInfo ->fetch( PDO::FETCH_ASSOC))
		{
			$sched_table[$days][$tasks][0] = $scheduleInfo_data['schedule_task_type'];
			$sched_table[$days][$tasks][1] = $scheduleInfo_data['schedule_time_from'];
			$sched_table[$days][$tasks][2] = $scheduleInfo_data['schedule_time_to'];

			$sched_table[$days][$tasks][1] = date( "H:i:s", strtotime( $sched_table[$days][$tasks][1]. " +0day"));
			$sched_table[$days][$tasks][2] = date( "H:i:s", strtotime( $sched_table[$days][$tasks][2]. " +0day"));

			$from_time = new DateTime($sched_table[$days][$tasks][1]);
			$to_time = new DateTime($sched_table[$days][$tasks][2]);

			$from_time->modify('-12 hours');
			$to_time->modify('-12 hours');

			$sched_table[$days][$tasks][1] = $from_time->format('H:i:s');
			$sched_table[$days][$tasks][2] = $to_time->format('H:i:s');
	
			++$tasks;
		}
	}
	$count = 0;		

	$start_time_pm = new DateTime('04:00:00'); //initializes the starting point of the schedule
	$end_time_pm = new DateTime('16:00:00'); //initializes the ending point of the schedule

	// identifies where to start the schedule
	$started = false;
	while($started === false)
	{	
		for($days=0; $days<5; $days++)
		{	
			$space = 0;
			for($tasks=0; $tasks<4; $tasks++)
			{

				if($sched_table[$days][$tasks][1] <= $start_time_pm ->format('H:i:s')   && $sched_table[$days][$tasks][2] > $start_time_pm ->format('H:i:s') )
				{
					$started = true;
				}	
				if($sched_table[$days+5][$tasks][1] <= $start_time_pm ->format('H:i:s')   && $sched_table[$days+5][$tasks][2] > $start_time_pm ->format('H:i:s') )
				{
					$started = true;
				}	
			}
		}
		if($started === false)
		{
			$start_time_pm->modify('+30 minutes');
		}
	}

	//identifies where to end the schedule
	$checking_start =  $start_time_pm->format('H:i:s');
	$checking_start = new DateTime($checking_start);
	$latest_time = '00:00:00';
	$latest_time = new DateTime($latest_time);

	while($checking_start < $end_time_pm)
	{	
		for($days=0; $days<5; $days++)
		{	
			$space = 0;
			for($tasks=0; $tasks<4; $tasks++)
			{
				if($sched_table[$days][$tasks][2] > $latest_time ->format('H:i:s'))
				{
					$latest_time = new DateTime($sched_table[$days][$tasks][2]);
				}
			}
		}
		$checking_start->modify('+30 minutes');
	}
	
	$end_time_pm = $latest_time->format('H:i:s');
	$end_time_pm = new DateTime($end_time_pm);

	// displays the schedule
	while($start_time_pm < $end_time_pm)
	{

		echo '<tr>';
		echo '<td>'.$start_time_pm ->format('H:i:s').'</td>';
		
		for($days=0; $days<5; $days++)
		{
			$space = 0;
			for($tasks=0; $tasks<4; $tasks++)
			{

				if($sched_table[$days][$tasks][1] <= $start_time_pm ->format('H:i:s')   && $sched_table[$days][$tasks][2] > $start_time_pm ->format('H:i:s') )
				{
					++$space;
					// echo 'current time: '.$start_time_pm ->format('H:i:s').'/not<br>';
					// echo $days .'<br>';
					// echo $sched_table[$days][$tasks][0].'<br>';
					// echo $sched_table[$days][$tasks][1].'<br>';
					// echo $sched_table[$days][$tasks][2].'<br><br>';

					if($sched_table[$days][$tasks][0] === 'Urgent')
					{
						echo '<td class="table-primary">'.$sched_table[$days][$tasks][0].'</td>';
					}
					else if($sched_table[$days][$tasks][0] === 'Application')
					{
						echo '<td class="table-info">'.$sched_table[$days][$tasks][0].'</td>';
					}
					else if($sched_table[$days][$tasks][0] === 'Docu-Sign')
					{
						echo '<td class="table-danger">'.$sched_table[$days][$tasks][0].'</td>';
					}
					else
					{
						echo '<td class="table-warning">'.$sched_table[$days][$tasks][0].'</td>';
					}			
				}
				// else
				// {
				// 	echo 'current time: '.$start_time_pm ->format('H:i:s').'/blank<br>';
				// 	echo $days .'<br>';
				// 	echo $sched_table[$days][$tasks][0].'<br>';
				// 	echo $sched_table[$days][$tasks][1].'<br>';
				// 	echo $sched_table[$days][$tasks][2].'<br><br>';
				// }
				
				// echo $task[$i] .' '.$from[$i] . ' ' . $start_time_pm ->format('H:i:s') .' '.$to[$i].'<br>';
			}

			if($space === 0)
			{
				echo '<td></td>';
			}

			$space = 0;
			for($tasks=0; $tasks<4; $tasks++)
			{

				if($sched_table[$days+5][$tasks][1] <= $start_time_pm ->format('H:i:s')   && $sched_table[$days+5][$tasks][2] > $start_time_pm ->format('H:i:s') )
				{
					++$space;
					// echo 'current time: '.$start_time_pm ->format('H:i:s').'/not<br>';
					// echo $days .'<br>';
					// echo $sched_table[$days][$tasks][0].'<br>';
					// echo $sched_table[$days][$tasks][1].'<br>';
					// echo $sched_table[$days][$tasks][2].'<br><br>';

					if($sched_table[$days+5][$tasks][0] === 'Legal-process')
					{
						echo '<td class="table-primary">'.$sched_table[$days+5][$tasks][0].'</td>';
					}
					else if($sched_table[$days+5][$tasks][0] === 'Name-Change')
					{
						echo '<td class="table-info">'.$sched_table[$days+5][$tasks][0].'</td>';
					}
					else if($sched_table[$days+5][$tasks][0] === 'AMIE')
					{
						echo '<td class="table-danger">'.$sched_table[$days+5][$tasks][0].'</td>';
					}
					else
					{
						echo '<td class="table-warning">'.$sched_table[$days+5][$tasks][0].'</td>';
					}			
				}
				// else
				// {
				// 	echo 'current time: '.$start_time_pm ->format('H:i:s').'/blank<br>';
				// 	echo $days .'<br>';
				// 	echo $sched_table[$days][$tasks][0].'<br>';
				// 	echo $sched_table[$days][$tasks][1].'<br>';
				// 	echo $sched_table[$days][$tasks][2].'<br><br>';
				// }
				
				// echo $task[$i] .' '.$from[$i] . ' ' . $start_time_pm ->format('H:i:s') .' '.$to[$i].'<br>';
			}

			if($space === 0)
			{
				echo '<td></td>';
			}
		}	

		
		$start_time_pm->modify('+30 minutes');
		echo '</tr>';

	}

	?>