<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';

	$myid = $_SESSION['employee_id'];
	date_default_timezone_set('Asia/Manila');

	$empid = $_GET['empid'];
    $date = $_GET['date'];
	// $date1 = $_POST['date1'];
	// $date2 = $_POST['date2'];

	$conn = new Database();

	$Sched = new Schedule($conn->databaseConnection());

	echo 
	'<table class="table table-striped table-bordered">
        <tr>
          <th rowspan="3" class="table-danger">Employee Name</th>
        </tr>
        <tr class="table-primary">';

	$date_of_sched = '2020-10-03';

	$spitted = explode("-", $date_of_sched);

	$year = $spitted[0];
	$month = $spitted[1]; 
	$day = $spitted[2]; 

	$start = $day + 0;
	$week = $start + 5;

	while($start < $week)
	{
		echo '<th>Oct '.$start.'</th>';
		++$start;
	}	

    echo
        '
        </tr>
        <tr class="table-info">
          <th>Mon</th>
          <th>Tue</th>
          <th>Wed</th>
          <th>Thu</th>
          <th>Fri</th>
        </tr>';


	
	$getAllId = $Sched->getAllEmployeeId();

	while($getAllId_data = $getAllId ->fetch( PDO::FETCH_ASSOC))
	{
		$empid = $getAllId_data['employee_id'];
		$fname = $getAllId_data['employee_fname'];
		$lname = $getAllId_data['employee_lname'];

		echo 
		'<tr>
	      <td>'.$lname.', '.$fname.'</td>';

	    $start = $day + 0;
		$week = $start + 5;

		while($start < $week)
		{
			$date = $year.'-'.$month.'-'.$start.'<br>';
			$checkedSched = $Sched->checkSchedIfExisting($empid, $date);

			if($checkedSched_data = $checkedSched ->fetch( PDO::FETCH_ASSOC))
		    {
		    	echo
		   		" <td><a href=''>View</a></td>";
		    }
		    else
		    {
		    	echo
		   		" <td><a href='add-schedule.php' style='color: red;'>Add</a></td>";
		    }
			++$start;
		}

	    
	}


	    echo
	    '
	    </tr>';

	// while($task_list_data = $task_list ->fetch( PDO::FETCH_ASSOC))
	// {
	// 	echo '</tr>';
	// }
	echo '</table>'

?>

