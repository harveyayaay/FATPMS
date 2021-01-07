<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/import.php';
	include_once '../../../process/obj/schedule.php';

	$conn = new Database();

	$Import = new Import($conn->databaseConnection());
	$Sched = new Schedule($conn->databaseConnection());

	$date_from = $date_week_from;
	$date_to = $date_week_to;

	$check = $Sched->checkDateIfExistingInSched($date_from, $date_to);
	if($check_data = $check->fetch(PDO::FETCH_ASSOC))
	{
		$date_result = $Sched->getAllDatesInSchedule($date_from, $date_to);
		while($date_result_data = $date_result->fetch(PDO::FETCH_ASSOC))
		{
			echo $date_search = $date_result_data['scheduling_date'].'<br>';
			$num_opener = 0;
			$num_closer = 0;
		
			$result = $Import->getScheduledEmployee($date_search);
			while($result_data = $result->fetch(PDO::FETCH_ASSOC))
			{
				$from = $result_data['scheduling_from'];
				$dt_from = new DateTime($from);
				$dt_from->modify('-12 hours');
				$from = $dt_from->format('H:i:s');	

				$to = $result_data['scheduling_to'];
				$dt_to = new DateTime($to);
				$dt_to->modify('-12 hours');
				$to = $dt_to->format('H:i:s');

				$dt_end = new DateTime($to);
				$dt_end->modify('-3 hours');
				$end = $dt_end->format('H:i:s');


				if($from < '12:00:00')
				{
					$opener_emp_id[$num_opener] = $result_data['scheduling_emp_id'];
					$opener_emp_from[$num_opener] = $from;
					$opener_emp_to[$num_opener] = $to;
					$opener_emp_end[$num_opener] = $end;
					++$num_opener;
				}
				else
				{
					$closer_emp_id[$num_closer] = $result_data['scheduling_emp_id'];
					$closer_emp_from[$num_closer] = $from;
					$closer_emp_to[$num_closer] = $to;
					$closer_emp_end[$num_closer] = $end;
					++$num_closer;
				}
			}
			
			echo '<table>';
			echo '<tr>';

			$row = 0;
			$primary = 0;
			$secondary = 0;
			for($i=0; $i<$num_opener;$i++)
			{
				// echo '<td>';
				// echo 'OPENER';
				// echo '<table border=1>';
				$start_time = "00:00:00";
				$end_time = "23:59:59";
				$dt_start_time = new DateTime($start_time);
				$dt_end_time = new DateTime($end_time);
				// echo '<tr><td>Time</td><td>'.$opener_emp_id[$i].'</td></tr>';
				$result = $Sched->getSchedulingTableId($opener_emp_id[$i], $date_search);
				$result_data = $result->fetch(PDO::FETCH_ASSOC);
				echo $Sched->schedule_id = $result_data['scheduling_id'].'<br>'; // id
				++$primary;
				++$secondary;
				while($dt_start_time < $dt_end_time)
				{
					if($dt_start_time->format('H:i:s') >= $opener_emp_from[$i] && $dt_start_time->format('H:i:s') < $opener_emp_to[$i])
					{
						if($num_opener === 3)
						{
							include 'opener_3.php';
						} // if < 3
						else
						{
							include 'opener_4.php';
						}
						
						$dt_start_time->modify('+60 minutes');
						$display_to = $dt_start_time->format('H:i:s');
						$dt_display_to = new DateTime($display_to);
						$dt_display_to = $dt_display_to->modify('+30 minutes');
						// echo '</td><tr>';

						// echo '<tr><td>'.$dt_display_to->format('H:i:s').'</td><td></td><tr>';
					}
					$dt_start_time->modify('+30 minutes');
				}
				// echo '</table>';
				// echo '</td>';
				++$row;	
			}

			$primary = 0;
			$secondary = 0;

			$row = 0;

			for($i=0; $i<$num_closer;$i++)
			{
				// echo '<td>';
				// echo 'CLOSER';
				// echo '<table border=1>';
				$start_time = "00:00:00";
				$end_time = "23:59:59";
				$dt_start_time = new DateTime($start_time);
				$dt_end_time = new DateTime($end_time);
				// echo '<tr><td>Time</td><td>'.$closer_emp_id[$i].'</td></tr>';
				$result = $Sched->getSchedulingTableId($closer_emp_id[$i], $date_search);
				$result_data = $result->fetch(PDO::FETCH_ASSOC);
				$Sched->schedule_id = $result_data['scheduling_id']; // id
				++$primary;
				++$secondary;
				while($dt_start_time < $dt_end_time)
				{	
					
					if($dt_start_time->format('H:i:s') >= $closer_emp_from[$i] && $dt_start_time->format('H:i:s') < $closer_emp_to[$i])
					{
						if($num_closer === 3)
						{
							include 'closer_3.php';
							
						} // if < 3
						else
						{
							include 'closer_4.php';
						}
						
						$dt_start_time->modify('+60 minutes');
						// echo '</td><tr>';		
					}
					
					
					
					$dt_start_time->modify('+30 minutes');


				}
				++$row;
			// 	// echo '</table>';
			// 	// echo '</td>';
			}
		}
	}
	// echo '</tr>';
	// echo '</table>';
?>