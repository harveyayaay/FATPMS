<?php
	echo '<table border = 1>';
		echo '<tr>';
			echo '<td>Time</td>';
			$result = $Import->getIdFromDate($date_search);
			while($result_data = $result->fetch(PDO::FETCH_ASSOC))
			{
				echo '<td>'.$result_data['scheduling_emp_id'].'</td>';
			}
		echo '</tr>';

		$start_time = "00:00:00";
		$end_time = "23:59:59";
		$dt_start_time = new DateTime($start_time);
		$dt_end_time = new DateTime($end_time);

		$start_found = false;
		$end_found = false;

		while($dt_start_time < $dt_end_time && $end_found == false)
		{
			$result = $Import->checkIfCurrentTimeExist($date_search);
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


				if($start_found == false)
				{
					if($dt_start_time->format('H:i:s') <= $from)
					{
						$start_time = $from;
						$start_found = true;
					}
				}
				if($dt_start_time->format('H:i:s') < $to)
				{
					$end_time = $to;
					$end_found = true;
				}
				
			}
			$dt_start_time->modify('+30 minutes');
		}

		$start_time = $start_time;
		$end_time = $end_time;
		$dt_start_time = new DateTime($start_time);
		$dt_end_time = new DateTime($end_time);
		$i = 1;
		$primary = 1;
		$secondary = 1;
		while($dt_start_time < $dt_end_time)
		{
			echo '<tr>';
			echo '<td>'.$dt_start_time->format('H:i:s').'</td>';
				$result = $Import->checkIfCurrentTimeExist($date_search);
				while($result_data = $result->fetch(PDO::FETCH_ASSOC))
				{
					$result_data['scheduling_emp_id'];

					$from = $result_data['scheduling_from'];
					$dt_from = new DateTime($from);
					$dt_from->modify('-12 hours');
					$from = $dt_from->format('H:i:s');

					$to = $result_data['scheduling_to'];
					$dt_to = new DateTime($to);
					$dt_to->modify('-12 hours');
					$to = $dt_to->format('H:i:s');

					if($dt_start_time->format('H:i:s') >= $from)
					{
						$started = true;
					}

					if($started == true)
					{
						if($dt_start_time->format('H:i:s') >= $from && $dt_start_time->format('H:i:s') < $to)
						{
							
							echo '<td>'.$primary.'</td>';
							if($primary > 3)
							{
								$primary = 1;
							}
							++$primary;
						}
						else
						{
							echo '<td></td>';
						}
					}
					
				}
				if($started == true)
				{
					if($primary < 4)
					{

					}
					$dt_start_time->modify('+60 minutes');
					echo '</tr>';
				}
			$dt_start_time->modify('+30 minutes');
		}
		echo '</table>';
?>