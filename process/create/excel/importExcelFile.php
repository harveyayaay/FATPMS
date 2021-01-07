<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';

	$conn = new Database();
	$Sched = new Schedule($conn->databaseConnection());

	if(isset($_FILES['excel']['name']))
	{
		include "xlsx.php";
		$excel=SimpleXLSX::parse($_FILES['excel']['tmp_name']);
		// echo "<pre>";	
			// print_r($excel->rows(1));
			// print_r($excel->sheetNames());
		        // $rowcol=$excel->dimension($sheet);
	    $i=0;
	    // if($rowcol[0]!=1 &&$rowcol[1]!=1)
	    // {
	    $id_found = false;
	    $date_found = false;
	    $count = 0;
	    $count_data = 0;
			$initial_date_set = false;
			foreach ($excel->rows() as $key => $data) 
			{
				$initial_date = date( "Y-m-d", strtotime($data[0]));
				if($data[0] == 'ID Number:')
				{
					// echo '<b>'.$data[0]. ' ' . $data[1].'</b><br>';
					$emp_id = $data[1];
					$id_found = true;
					++$count_data;
					$date_found = false;
				}


				if($date_found == true)
				{
					if($data[2] == null)
					{
						$count = 0;
						$id_found = false;
					}
					else
					{
						if($data[3] == 'REST DAY' || $data[3] == 'ON LEAVE' || $data[3] == 'REST DAY AND HOLIDAY' )
						{
							
						}
						else if($data[0] != NULL)	
						{
							$shifts_time = explode(" To ", $data[3]);
							// $shifts_time_from[$i] = $shifts_time[0];
							// $shifts_time_to[$i] = $shifts_time[1];
							$Sched->scheduling_emp_id = $emp_id;
							$Sched->scheduling_date = date( "Y-m-d", strtotime($data[0]));
							$Sched->scheduling_from = date( "H:i:s", strtotime($shifts_time[0]));
							$Sched->scheduling_to = date( "H:i:s", strtotime($shifts_time[1]));

							if($initial_date_set === false)
							{
								$date_week_to = $date_week_from = $initial_date;
								$initial_date_set = true;
							}
							else
							{
								if(date( "Y-m-d", strtotime($data[0])) < $date_week_from)
									$date_week_from = date( "Y-m-d", strtotime($data[0]));

								if(date( "Y-m-d", strtotime($data[0])) >$date_week_to)
									$date_week_to = date( "Y-m-d", strtotime($data[0]));
							}
							$Sched->insertDataFromExcel();
						}
					}
				}
				if($id_found == true)
				{
					++$count;
				}
				if($data[0] == 'Date')
				{
					$date_found = true;
				}
				++$i;
			}
			
		include 'showFirstSample.php';
		include '../employee/getAllFrontliner.php';
		while($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
		{
			$empid = $result_emp_data['employee_id'];
			$message = 'The schedule from '.date('F j', strtotime($date_week_from)).' to '.date('F j', strtotime($date_week_to)).' has been plotted.';
			include '../notification/addNotif.php';
		}
		header("location: ../../../render/supervisor/body/scheduling.php");
	}
?>

