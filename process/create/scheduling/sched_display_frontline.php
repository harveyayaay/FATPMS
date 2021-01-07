<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';
	include_once '../../../process/obj/task-list.php';
	
	$conn = new Database();

	$Sched = new Schedule($conn->databaseConnection());
	$TaskList = new TaskList($conn->databaseConnection());

	$start_time = "00:00:00";
	$end_time = "23:59:59";
	$dt_start_time = new DateTime($start_time);
	$dt_end_time = new DateTime($end_time);

	$start_found = false;
	$end_found = false;

	$Y = $_POST['Y'];
	$m = $_POST['m'];
	$d = $_POST['d'];

	$datepicked = $Y.'-'.$m.'-'.$d;
	$datepicked = date( "Y-m-d", strtotime( $datepicked));
	$date = date( "F j", strtotime( $datepicked. " +0day"));
	$day = date( "l", strtotime( $datepicked. " +0day"));

	$result = $Sched->checkIfDateExists($datepicked);
	if($result_data = $result->fetch(PDO::FETCH_ASSOC))
	{
		while($dt_start_time < $dt_end_time && $end_found == false)
		{
			$result = $Sched->checkIfCurrentTimeExist($datepicked);
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

		$countid = 0;
		$result = $Sched->getAllIdOfSameDate($datepicked);
		while($result_data = $result ->fetch( PDO::FETCH_ASSOC))
		{
			$id[$countid] = $result_data['scheduling_id'];
			++$countid;
		}

		$start_time = $start_time;
		$end_time = $end_time;
		$dt_start_time = new DateTime($start_time);
		$dt_end_time = new DateTime($end_time);
		
		echo '
		<div class="">
			<table class="table table-bordered">
				<tr>
					<td colspan="9"><h5 class=center>'.$date .' ('.$day. ')</h5></td>
				</tr>
				<tr>
					<td class="table-orange">Time</td>';

					$level[0] = 'Primary';
					$level[1] = 'Secondary';
					$primary_count = 0;
					$secondary_count = 0;
					for($i=0; $i<2; $i++)
					{
						$result = $TaskList->getTaskList($level[$i]);
						while($result_data = $result->fetch(PDO::FETCH_ASSOC))
						{
							echo'<td class="table-orange">'.$result_data['task_list_title'].'</td>';
							if($i === 0)
							{
								++$primary_count;
							}
							else
							{
								++$secondary_count;
							}
						}
					}
				echo'	
				</tr>
				<tr>';
					
				
		while($dt_start_time < $dt_end_time)
		{
			$primary = 1;
			$secondary = 1;
			
			$s_secondary = 'S'.$secondary;
			$search_time = $dt_start_time->format('H:i:s');
			$dt_search_time = new DateTime($search_time);
			$dt_search_time->modify('+12 hours');

			$to_time = $dt_start_time->format('H:i:s');
			$dt_to_time = new DateTime($to_time);
			$dt_to_time->modify('+90 minutes');
			echo '<td class="table-orange-outline">'.$dt_start_time->format('H:i:s').' - '.$dt_to_time->format('H:i:s').'</td>';

			while($primary < $primary_count+1)
			{
				$task_found = false;
				$p_primary = 'P'.$primary;
				if($dt_search_time->format('H:i:s') >= '21:00:00')
				{
					for($i=0;$i<$countid;$i++)
					{
						$result_time = $Sched->checkOnTimeTaskType($id[$i], $dt_search_time->format('H:i:s'), $p_primary);
						if($result_time_data = $result_time->fetch(PDO::FETCH_ASSOC))
						{
							$task_found = true;
							$result_sched = $Sched->getSchedulingEmpId($result_time_data['schedule_id']);
							if($result_sched_data = $result_sched->fetch(PDO::FETCH_ASSOC))
							{
								$result_emp = $Sched->getEmployeeName($result_sched_data['scheduling_emp_id']);
								if($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
								{
									if($result_sched_data['scheduling_emp_id'] == $emp_id)
										echo '<td class="table-dark">'.$result_emp_data['employee_lname'].', '.$result_emp_data['employee_fname'].'</td>';
									else
										echo '<td>'.$result_emp_data['employee_lname'].', '.$result_emp_data['employee_fname'].'</td>';
								}	
								
							}	
						}
					}
					if($task_found == false)
					{
						echo '<td></td>';
					}		
				}
				else if($dt_search_time->format('H:i:s') <	'21:00:00')
				{	
					$dt_search_time->modify('-24 hours');

					for($i=0;$i<$countid;$i++)
					{
						$result_time = $Sched->checkOnTimeTaskType($id[$i], $dt_search_time->format('H:i:s'), $p_primary);
						if($result_time_data = $result_time->fetch(PDO::FETCH_ASSOC))
						{
							$task_found = true;
							$result_sched = $Sched->getSchedulingEmpId($result_time_data['schedule_id']);
							if($result_sched_data = $result_sched->fetch(PDO::FETCH_ASSOC))
							{
								$result_emp = $Sched->getEmployeeName($result_sched_data['scheduling_emp_id']);
								if($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
								{
									if($result_sched_data['scheduling_emp_id'] == $emp_id)
										echo '<td class="table-dark">'.$result_emp_data['employee_lname'].', '.$result_emp_data['employee_fname'].'</td>';
									else
										echo '<td>'.$result_emp_data['employee_lname'].', '.$result_emp_data['employee_fname'].'</td>';
								}	
							}	
						}
					}
					if($task_found == false)
					{	
						echo '<td></td>';
					}
				}
				++$primary;
				
			}
			while($secondary < $secondary_count+1)
			{
				$task_found = false;
				$s_secondary = 'S'.$secondary;
				if($dt_search_time->format('H:i:s') >= '21:00:00')
				{
					for($i=0;$i<$countid;$i++)
					{
						$result_time = $Sched->checkOnTimeTaskType($id[$i], $dt_search_time->format('H:i:s'), $s_secondary);
						if($result_time_data = $result_time->fetch(PDO::FETCH_ASSOC))
						{
							$task_found = true;
							$result_sched = $Sched->getSchedulingEmpId($result_time_data['schedule_id']);
							if($result_sched_data = $result_sched->fetch(PDO::FETCH_ASSOC))
							{
								$result_emp = $Sched->getEmployeeName($result_sched_data['scheduling_emp_id']);
								if($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
								{
									if($result_sched_data['scheduling_emp_id'] == $emp_id)
										echo '<td class="table-dark">'.$result_emp_data['employee_lname'].', '.$result_emp_data['employee_fname'].'</td>';
									else
										echo '<td>'.$result_emp_data['employee_lname'].', '.$result_emp_data['employee_fname'].'</td>';
								}	
								
							}	
						}
					}
					if($task_found == false)
					{
						echo '<td></td>';
					}		
				}
				else if($dt_search_time->format('H:i:s') <	'21:00:00')
				{	
					$dt_search_time->modify('-24 hours');

					for($i=0;$i<$countid;$i++)
					{
						$result_time = $Sched->checkOnTimeTaskType($id[$i], $dt_search_time->format('H:i:s'), $s_secondary);
						if($result_time_data = $result_time->fetch(PDO::FETCH_ASSOC))
						{
							$task_found = true;
							$result_sched = $Sched->getSchedulingEmpId($result_time_data['schedule_id']);
							if($result_sched_data = $result_sched->fetch(PDO::FETCH_ASSOC))
							{
								$result_emp = $Sched->getEmployeeName($result_sched_data['scheduling_emp_id']);
								if($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
								{
									if($result_sched_data['scheduling_emp_id'] == $emp_id)
										echo '<td class="table-dark">'.$result_emp_data['employee_lname'].', '.$result_emp_data['employee_fname'].'</td>';
									else
										echo '<td>'.$result_emp_data['employee_lname'].', '.$result_emp_data['employee_fname'].'</td>';
								}	
							}	
						}
					}
					if($task_found == false)
					{
						echo '<td></td>';
					}
				}
				++$secondary;
			}
			echo '<tr></tr>';
			
			$dt_start_time->modify('+90 minutes');

		}
		echo '</tr>
			</table>
		</div>';
	}
	else
	{
		echo '
		<table class="table table-bordered">
			<tr>
				<td><h5 class=center>'.$date .' ('.$day. ')</h5></td>
			</tr>
			<tr>
				<td class="b-space"><h5 class=center>No Schedule Available</h5></td>
			</tr>
		</table>
		';
	}
	
?>
	<div id="addModal" class="modal fade">
		<div class="modal-dialog modal-sm">
		  <div class="card container modal-content">
		  	<form action= "../../../process/create/schedule/addEmployeeToSched.php" method = "post">
					<div class="card-header justify">
						<div id="display1">
							
						</div>
					</div>
					<div class="card-body buttons">
					  <button data-dismiss="modal" class="btn cancel-btn">Cancel</button>
					  <button class="btn add-btn">Save Changes</button>
					</div>	
				</form>
	  	</div>
		</div>
	</div>

	<div id="editModal" class="modal fade">
		<div class="modal-dialog modal-sm">
		  <div class="card container modal-content">
		  	<form action= "../../../process/create/schedule/editEmployeeToSched.php" method = "post">
					<div class="card-header justify">
						<div id="display2">
							
						</div>
					</div>
					<div class="card-body buttons">
					  <button data-dismiss="modal" class="btn cancel-btn">Cancel</button>
					  <button class="btn add-btn">Save Changes</button>
					</div>	
				</form>
	  	</div>
		</div>
	</div>
	<?php include '../../../process/create/scheduling/checkFileImporting.php'; ?>

<style type="text/css">
.center
{
    display: flex;
    justify-content: center;
}
.b-space
{
	margin: auto;
	height: 450px;
}
.addemp
{
	padding-top: 100px;
}
.modal-content
{
	margin-top: 100%;
}
.editsched
{
	color: #000;
}

</style>

