<?php

	class Task
	{

		public $conn;

		public 
			$task_id,
		    $task_datetime,
		    $task_type,
		    $task_client_name,
		    $task_client_id,
		    $task_date_received, 
		    $task_start_time,
		    $task_hold_start_time,
		    $task_hold_end_time, 
		    $task_end_time, 
			$task_duration,
			$task_status, 
		    $task_employee_id;


		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function storeInitialTask()
		{
			$query = 'INSERT INTO task_table
						SET
						    task_datetime=:task_datetime,
						    task_type=:task_type,
						    task_client_name=:task_client_name,
						    task_client_id=:task_client_id,
						    task_date_received=:task_date_received, 
						    task_start_time=:task_start_time,
						    task_hold_start_time=:task_hold_start_time,
						    task_hold_end_time=:task_hold_end_time, 
						    task_end_time=:task_end_time, 
						    task_status=:task_status, 
						    task_employee_id=:task_employee_id';

			$stmt = $this->conn->prepare($query);

			$this->task_datetime = htmlspecialchars(strip_tags($this->task_datetime));
			$this->task_type = htmlspecialchars(strip_tags($this->task_type));
			$this->task_client_name = htmlspecialchars(strip_tags($this->task_client_name));
			$this->task_client_id = htmlspecialchars(strip_tags($this->task_client_id));
			$this->task_date_received = htmlspecialchars(strip_tags($this->task_date_received));
			$this->task_start_time = htmlspecialchars(strip_tags($this->task_start_time));
			$this->task_hold_start_time = htmlspecialchars(strip_tags($this->task_hold_start_time));
			$this->task_hold_end_time = htmlspecialchars(strip_tags($this->task_hold_end_time));
			$this->task_end_time = htmlspecialchars(strip_tags($this->task_end_time));
			$this->task_status = htmlspecialchars(strip_tags($this->task_status));
			$this->task_employee_id = htmlspecialchars(strip_tags($this->task_employee_id));

			$stmt->bindParam(':task_datetime', $this->task_datetime);
			$stmt->bindParam(':task_type', $this->task_type);
			$stmt->bindParam(':task_client_name', $this->task_client_name);
			$stmt->bindParam(':task_client_id', $this->task_client_id);
			$stmt->bindParam(':task_date_received', $this->task_date_received);
			$stmt->bindParam(':task_start_time', $this->task_start_time);
			$stmt->bindParam(':task_hold_start_time', $this->task_hold_start_time);
			$stmt->bindParam(':task_hold_end_time', $this->task_hold_end_time);
			$stmt->bindParam(':task_end_time', $this->task_end_time);
			$stmt->bindParam(':task_status', $this->task_status);
			$stmt->bindParam(':task_employee_id', $this->task_employee_id);

			if($stmt->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		} //function storeInitialTask() ends

		function viewOnholdTask($emp_id)
		{
			$query = "SELECT * FROM `task_table`
						WHERE `task_status` = 'On-hold'
						AND `task_employee_id` = '$emp_id'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function viewOnholdTask() ends

		function viewCompletedTask($emp_id)
		{
			$date = date('Y-m-d');
			$time = date('H:i:s');
			$query = "SELECT * 
						FROM `task_table`
						WHERE `task_status` = 'Completed'
						AND `task_employee_id` = '$emp_id'
						AND (`task_datetime` = '$date')";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function viewCompletedTask() ends

		function updateHoldStartTimeTask($id)
		{
			$query = 'UPDATE task_table
						SET
						    task_hold_start_time=:task_hold_start_time, 
						    task_hold_end_time=:task_hold_end_time, 
						    task_end_time=:task_end_time, 
						    task_status=:task_status
						   	WHERE task_id = ' . $id;

			$stmt = $this->conn->prepare($query);

			$this->task_hold_start_time = htmlspecialchars(strip_tags($this->task_hold_start_time));
			$this->task_hold_end_time = htmlspecialchars(strip_tags($this->task_hold_end_time));
			$this->task_end_time = htmlspecialchars(strip_tags($this->task_end_time));
			$this->task_status = htmlspecialchars(strip_tags($this->task_status));

			$stmt->bindParam(':task_hold_start_time', $this->task_hold_start_time);
			$stmt->bindParam(':task_hold_end_time', $this->task_hold_end_time);
			$stmt->bindParam(':task_end_time', $this->task_end_time);
			$stmt->bindParam(':task_status', $this->task_status);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function updateEndTimeTask() ends

		function updateHoldEndTimeTask($id)
		{
			$query = 'UPDATE task_table
						SET
						    task_hold_end_time=:task_hold_end_time, 
						    task_end_time=:task_end_time, 
						    task_status=:task_status
						    	WHERE task_id LIKE ' . $id;

			$stmt = $this->conn->prepare($query);

			$this->task_hold_end_time = htmlspecialchars(strip_tags($this->task_hold_end_time));
			$this->task_end_time = htmlspecialchars(strip_tags($this->task_end_time));
			$this->task_status = htmlspecialchars(strip_tags($this->task_status));

			$stmt->bindParam(':task_hold_end_time', $this->task_hold_end_time);
			$stmt->bindParam(':task_end_time', $this->task_end_time);
			$stmt->bindParam(':task_status', $this->task_status);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function updateHoldEndTimeTask() ends

		function updateEndTimeTask($id)
		{
			$query = 'UPDATE task_table
						SET
						    task_end_time=:task_end_time, 
						    task_status=:task_status
						    	WHERE task_id LIKE ' . $id;

			$stmt = $this->conn->prepare($query);

			$this->task_end_time = htmlspecialchars(strip_tags($this->task_end_time));
			$this->task_status = htmlspecialchars(strip_tags($this->task_status));

			$stmt->bindParam(':task_end_time', $this->task_end_time);
			$stmt->bindParam(':task_status', $this->task_status);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function updateEndTimeTask() ends

		function updateDuration($id)
		{
			$query = 'UPDATE task_table
						SET
						    task_duration=:task_duration
						    	WHERE task_id = ' . $id;

			$stmt = $this->conn->prepare($query);

			$this->task_duration = htmlspecialchars(strip_tags($this->task_duration));

			$stmt->bindParam(':task_duration', $this->task_duration);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function updateDuration() ends

		function checkOngoingTask($emp_id)
		{
			$query = "SELECT COUNT(*) as 'count' 
						FROM `task_table`
						WHERE `task_status` = 'Ongoing'
						AND `task_employee_id` = '$emp_id'";


			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function checkOngoingTask() ends

		function checkOnholdTask($emp_id)
		{
			$query = "SELECT COUNT(*) as 'count' 
						FROM `task_table`
						WHERE `task_status` = 'On-hold'
						AND `task_employee_id` = '$emp_id'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function checkOnholdTask() ends

		function checkCompletedTask($emp_id)
		{
			$query = "SELECT COUNT(*) as 'count' 
						FROM `task_table`
						WHERE `task_status` = 'Completed'
						AND `task_employee_id` = '$emp_id'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function updateEndShift()
		{	
			$query = "UPDATE task_table
						SET task_status=:task_status
						WHERE task_employee_id=:task_employee_id";

			$stmt = $this->conn->prepare($query);

			$this->task_status = htmlspecialchars(strip_tags($this->task_status));
			$this->task_employee_id = htmlspecialchars(strip_tags($this->task_employee_id));

			$stmt->bindParam(':task_status', $this->task_status);
			$stmt->bindParam(':task_employee_id', $this->task_employee_id);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends


		function viewOngoingTaskSV()
		{
			$query = "SELECT `t.task_employee_id`, 
							`t.task_type`, 
							`t.task_start_time`, 
							`t.task_hold_start_time`, 
							`t.task_hold_end_time`
					FROM `task_table t`, `employee_account e`
					WHERE `t.task_status` = 'Ongoing'
					AND `e.employee_position_title` = 'Frontliner'
					AND `e.employee_id` = `t.task_employee_id`";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function viewOngoingTask()
		{
			$query = "SELECT * FROM task_table
				WHERE 
					task_status = 'Ongoing'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function viewCompletedTaskSV()
		{
			$query = "SELECT * FROM task_table
				WHERE 
					task_status = 'Completed'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function countIndividualVolume($id, $from, $to)
		{
			$query = "SELECT COUNT(*) as countvol
					FROM `task_table`
					WHERE `task_status` = 'Completed'
					AND `task_employee_id` = '$id'
					AND `task_datetime` >= '$from'
					AND `task_datetime` <= '$to'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getProcessingTimeApplication($empid, $taskid, $from, $to)
		{
			$query = "SELECT `task_duration`
					FROM `task_table`
					WHERE `task_status` = 'Completed'
					AND `task_employee_id` = '$empid'
					AND `task_type` = '$taskid'
					AND `task_datetime` >= '$from'
					AND `task_datetime` <= '$to'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getProdDuration($date, $taskid, $empid)
		{
			$query = "SELECT *
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_type = '$taskid'
					AND task_status = 'Completed'
					AND task_employee_id = '$empid'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function countTask($date, $taskid, $empid)
		{
			$query = "SELECT COUNT(*) as counted
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_type = '$taskid'
					AND task_status = 'Completed'
					AND task_employee_id = '$empid'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getYTDVolume($date, $taskid)
		{
			$query = "SELECT COUNT(*) as counted
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_type = '$taskid'
					AND task_status = 'Completed'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends
		
		function getOngoingTaskUsingDateAndEmployeeId($date, $empid)
		{
			$query = "SELECT *
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_employee_id = '$empid'
					AND task_status = 'Ongoing'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getTaskUsingTaskType($date, $taskid)
		{
			$query = "SELECT *
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_type = '$taskid'
					AND task_status = 'Completed'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getTaskUsingDateAndType($date, $tid)
		{
			$query = "SELECT *
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_type = '$tid'	
					AND task_status = 'Completed'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function countTaskUsingDates($date1, $date2)
		{
			// echo $date1.' ';
			// echo $date2;
			// echo '<br>';
			$query = "SELECT COUNT(*) as counted
					FROM task_table
					WHERE task_datetime >= '$date1'
					AND task_datetime <= '$date2'
					AND task_status = 'Completed'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function countTaskUsingDatesAndType($tid, $date1, $date2)
		{
			$query = "SELECT COUNT(*) as counted
					FROM task_table
					WHERE task_datetime >= '$date1'
					AND task_datetime <= '$date2'
					AND task_type = '$tid'
					AND task_status = 'Completed'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getTaskUsingDateAndEmployeeId($date, $empid)
		{
			$query = "SELECT *
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_employee_id = '$empid'	
					AND task_status = 'Completed'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function checkTaskUsingDateAndEmployeeId($date, $empid)
		{
			$query = "SELECT *
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_employee_id = '$empid'	
					AND task_status = 'Completed'
					GROUP BY task_id";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function countTaskUsingDate($date)
		{
			$query = "SELECT COUNT(*) as counted
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_status = 'Completed'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function countTaskUsingDateAndEmpId($date, $empid)
		{
			$query = "SELECT COUNT(*) as counted
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_employee_id = '$empid'
					AND task_status = 'Completed'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function countTaskUsingDateAndType($date, $type)
		{
			$query = "SELECT COUNT(*) as counted
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_type = '$type'
					AND task_status = 'Completed'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function countTaskUsingDateTypeAndEmpid($date, $type, $empid)
		{
			$query = "SELECT COUNT(*) as counted
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_type = '$type'
					AND task_employee_id = '$empid'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getTaskUsingDateTypeAndEmployeeId($date, $taskid, $empid)
		{
			$query = "SELECT *
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_type = '$taskid'
					AND task_status = 'Completed'
					AND task_employee_id = '$empid'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getProcessTimeOfEmployeeUsingDateAndType($date, $tid, $empid)
		{
			$query = "SELECT task_duration
					FROM task_table
					WHERE task_datetime = '$date'
					AND task_type = '$tid'
					AND task_status = 'Completed'
					AND task_employee_id = '$empid'";

			$stmt = $this->conn->prepare($query);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends
		

	} // class ends

	


?>
