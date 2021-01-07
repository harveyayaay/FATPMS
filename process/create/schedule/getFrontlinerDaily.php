
<tr>
  <td class="center-text table-bordered" rowspan="2">Time</td>
  <?php
	echo'<td colspan="2" class="center-text table-bordered">';
	    echo '<b>'.date("F j", strtotime( $date)) .' ('.date( "l", strtotime( $date)).')</b>';
	echo '</td>';
  ?>
</tr>
<tr>
	<td class="center-text table-bordered">Primary</td>
	<td class="center-text table-bordered">Secondary</td>
</tr>

<?php
		$tasks = 0;
		$count = 0;
		$scheduleInfo = $Sched->getSchedule($sched_id, 'Primary');
	
		while($scheduleInfo_data = $scheduleInfo ->fetch( PDO::FETCH_ASSOC))
		{
			$sched_task[$count] = $scheduleInfo_data['schedule_task_type'];
			$sched_from[$count] = $scheduleInfo_data['schedule_time_from'];
			$sched_to[$count] = $scheduleInfo_data['schedule_time_to'];

			$sched_from[$count] = date( "H:i:s", strtotime( $sched_from[$count]. " +0day"));
			$sched_to[$count] = date( "H:i:s", strtotime( $sched_to[$count]. " +0day"));

			$from_time = new DateTime($sched_from[$count]);
			$to_time = new DateTime($sched_to[$count]);

			$from_time->modify('-12 hours');
			$to_time->modify('-12 hours');

			$sched_from[$count] = $from_time->format('H:i:s');
			$sched_to[$count] = $to_time->format('H:i:s');
			++$count;
		}

		$tasks = 0;
		$scheduleInfo = $Sched->getSchedule($sched_id, 'Secondary');
	
		while($scheduleInfo_data = $scheduleInfo ->fetch( PDO::FETCH_ASSOC))
		{
			$sched_task[$count] = $scheduleInfo_data['schedule_task_type'];
			$sched_from[$count] = $scheduleInfo_data['schedule_time_from'];
			$sched_to[$count] = $scheduleInfo_data['schedule_time_to'];

			$sched_from[$count] = date( "H:i:s", strtotime( $sched_from[$count]. " +0day"));
			$sched_to[$count] = date( "H:i:s", strtotime( $sched_to[$count]. " +0day"));

			$from_time = new DateTime($sched_from[$count]);
			$to_time = new DateTime($sched_to[$count]);

			$from_time->modify('-12 hours');
			$to_time->modify('-12 hours');

			$sched_from[$count] = $from_time->format('H:i:s');
			$sched_to[$count] = $to_time->format('H:i:s');
			++$count;
		}	


	$start_time_pm = new DateTime('04:00:00'); //initializes the starting point of the schedule
	$end_time_pm = new DateTime('16:00:00'); //initializes the ending point of the schedule


	// identifies where to start the schedule
	$started = false;
	while($started === false)
	{	
			
		$space = 0;
		for($count=0; $count<4; $count++)
		{

			if($sched_from[$count] <= $start_time_pm ->format('H:i:s')   && $sched_to[$count] > $start_time_pm ->format('H:i:s') )
			{
				$started = true;
			}	
			if($sched_from[$count] <= $start_time_pm ->format('H:i:s')   && $sched_to[$count] > $start_time_pm ->format('H:i:s') )
			{
				$started = true;
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
		$space = 0;
		for($count=0; $count<4; $count++)
		{
			if($sched_to[$count] > $latest_time ->format('H:i:s'))
			{
				$latest_time = new DateTime($sched_to[$count]);
			}
		}
		$checking_start->modify('+30 minutes');
	}
	
	$end_time_pm = $latest_time->format('H:i:s');
	$end_time_pm = new DateTime($end_time_pm);


	
	while($start_time_pm < $end_time_pm)
	{
		echo '<tr>';
		echo '<td class="center-text">'.$start_time_pm ->format('H:i:s').'</td>';
		
		$space = 0;
		for($count=0; $count<4; $count++)
		{

			if($sched_from[$count] <= $start_time_pm ->format('H:i:s')   && $sched_to[$count] > $start_time_pm ->format('H:i:s') )
			{
				++$space;
				
				if($sched_task[$count] === 'Urgent')
				{
					echo '<td class="table-primary">'.$sched_task[$count].'</td>';
				}
				else if($sched_task[$count] === 'Application')
				{
					echo '<td class="table-info">'.$sched_task[$count].'</td>';
				}
				else if($sched_task[$count] === 'Docu-Sign')
				{
					echo '<td class="table-danger">'.$sched_task[$count].'</td>';
				}
				else
				{
					echo '<td class="table-warning">'.$sched_task[$count].'</td>';
				}			
			}
		
		}

		for($count=4; $count<8; $count++)
		{

			if($sched_from[$count] <= $start_time_pm ->format('H:i:s')   && $sched_to[$count] > $start_time_pm ->format('H:i:s') )
			{
				++$space;
				
				if($sched_task[$count] === 'Legal-process')
				{
					echo '<td class="table-primary">'.$sched_task[$count].'</td>';
				}
				else if($sched_task[$count] === 'Name-Change')
				{
					echo '<td class="table-info">'.$sched_task[$count].'</td>';
				}
				else if($sched_task[$count] === 'AMIE')
				{
					echo '<td class="table-danger">'.$sched_task[$count].'</td>';
				}
				else
				{
					echo '<td class="table-warning">'.$sched_task[$count].'</td>';
				}			
			}
		
		}	

		if($space === 0)
		{
			echo '<td></td>';
		}
		

		
		$start_time_pm->modify('+30 minutes');
		echo '</tr>';

	}


	?>