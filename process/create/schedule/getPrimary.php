<?php

$scheduleInfo = $Sched->getSchedule($scheduling_id, 'Primary');
$count = 0;
$content = 0;
while($scheduleInfo_data = $scheduleInfo ->fetch( PDO::FETCH_ASSOC))
{
	++$content;
	$task[$count] = $scheduleInfo_data['schedule_task_type'];
	$from[$count] = $scheduleInfo_data['schedule_time_from'];
	$to[$count] = $scheduleInfo_data['schedule_time_to'];
	$from[$count] = date( "H:i:s", strtotime( $from[$count]. " +0day"));
	$to[$count] = date( "H:i:s", strtotime( $to[$count]. " +0day"));

	$from_time = new DateTime($from[$count]);
	$to_time = new DateTime($to[$count]);

	$from_time->modify('-12 hours');
	$to_time->modify('-12 hours');

	$from[$count] = $from_time->format('H:i:s');
	$to[$count] = $to_time->format('H:i:s');
	
	$duration = $to_time ->diff($from_time);


	$str_duration[$count] = $duration ->format('%H:%I:%S');

	++$count;
}

$count = 0;		


$start_time_pm = new DateTime('04:00:00');
$end_time_pm = new DateTime('16:00:00');

while($start_time_pm < $end_time_pm)
{
	$space = 0;
	for($i=0; $i<4; $i++)
	{
		if($start_time_pm ->format('H:i:s') >= $from[$i] && $start_time_pm ->format('H:i:s') < $to[$i])
		{
			++$space;
			if($task[$i] == 'Urgent')
			{
				echo '<td class="table-primary"></td>';
			}
			else if($task[$i] == 'Application')
			{
				echo '<td class="table-info"></td>';
			}
			else if($task[$i] == 'Docu-Sign')
			{
				echo '<td class="table-danger"></td>';
			}
			else
			{
				echo '<td class="table-warning"></td>';
			}
			
		}
		
		// echo $task[$i] .' '.$from[$i] . ' ' . $start_time_pm ->format('H:i:s') .' '.$to[$i].'<br>';
	}

	if($space == 0)
	{
			echo '<td></td>';
	}

	$start_time_pm->modify('+30 minutes');
}
	?>