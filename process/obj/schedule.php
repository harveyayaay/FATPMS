<?php

	class Schedule
	{

		public $conn;

		public 
			$scheduling_id,
			$scheduling_emp_id,
			$scheduling_date,
			$scheduling_from,
			$scheduling_to,
			$schedule_id,
			$schedule_time_from,
			$schedule_time_to,
			$schedule_task_list_id,
			$schedule_importance,
			$schedule_quantity;



		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function getAllEmployeeId()
		{
			$query = "SELECT *
						FROM `employee_account`
						WHERE `employee_position_title` = 'Frontliner'
						ORDER BY `employee_lname`";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getAllEmployeeId() ends

		function getEmployeeName($id)
		{
			$query = "SELECT *
						FROM `employee_account`
						WHERE `employee_id` = '$id'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getEmployeeName() ends

		function checkIfCurrentTimeExist($date)
		{
			$query = "SELECT *
						FROM `scheduling_table`
						WHERE `scheduling_date` = '$date'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function checkIfCurrentTimeExist() ends

		function checkIfDateExists($date)
		{
			// echo $empid . '<br>' . $date . '<br>';
			$query = "SELECT `scheduling_id`
						FROM `scheduling_table`
						WHERE `scheduling_date` = '$date'";

			$stmt = $this->conn->prepare($query);
			if($stmt->execute())
			{ 
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function checkIfDateExists() ends

		function getEmployeeDetails($empid)
		{
			$query = "SELECT *
						FROM `employee_account`
						WHERE `employee_id` = '$empid'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getEmployeeDetails() ends

		function getSchedulingTableId($empid, $date)
		{
			$query = "SELECT `scheduling_id`
						FROM `scheduling_table`
						WHERE `scheduling_emp_id` = '$empid'
						AND `scheduling_date` = '$date'";

			$stmt = $this->conn->prepare($query);
			if($stmt->execute())
			{ 
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getSchedulingTableId() ends

		function getSchedulingEmpId($id)
		{
			$query = "SELECT `scheduling_emp_id`
						FROM `scheduling_table`
						WHERE `scheduling_id` = '$id'";

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

		function getAllDatesInSchedule($date_from, $date_to)
		{
			$query = "SELECT `scheduling_date`
						FROM `scheduling_table`
						WHERE `scheduling_date` >= '$date_from'
						AND `scheduling_date` <= '$date_to'
						GROUP BY `scheduling_date`";

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

		function checkDateIfExistingInSched($date_from, $date_to)
		{
			$query = "SELECT `scheduling_date`
						FROM `scheduling_table`
						WHERE `scheduling_date` >= '$date_from'
						AND `scheduling_date` <= '$date_to'
						GROUP BY `scheduling_date`
						ORDER BY `scheduling_date`";

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

		function getAllIdOfSameDate($date)
		{
			$query = "SELECT `scheduling_id`
						FROM `scheduling_table`
						WHERE `scheduling_date` = '$date'";

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

		function getSchedTime($task, $time)
		{
			$query = "SELECT *
						FROM `schedule_table`
						WHERE `schedule_time_from` = '$time'
						AND `schedule_task_list_id` = '$task'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getAllIdOfSameDate() ends

		function checkOnTimeTaskType($id, $time, $task)
		{
			$query = "SELECT `schedule_id`
						FROM `schedule_table`
						WHERE `schedule_time_from` = '$time'
						AND `schedule_task_list_id` = '$task'
						AND `schedule_id` = '$id'
						GROUP BY `schedule_id`";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function checkOnTimeTaskType() ends

		function getSchedule($empid, $importance)
		{
			$query = "SELECT *
						FROM `schedule_table`
						WHERE `schedule_id` = '$empid'
						AND `schedule_importance` = '$importance'
						ORDER BY `schedule_time_from`";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getSchedule() ends

		function checkSchedIfExisting($empid, $date)
		{
			$query = "SELECT *
						FROM `scheduling_table`
						WHERE `scheduling_emp_id` = '$empid'
						AND `scheduling_date` = '$date'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function checkSchedIfExisting() ends

		function insertDataInScheduling()
		{
			$query = 'INSERT INTO scheduling_table
						SET
							scheduling_emp_id=:scheduling_emp_id,
							scheduling_date=:scheduling_date';

			$stmt = $this->conn->prepare($query);

			$this->scheduling_emp_id = htmlspecialchars(strip_tags($this->scheduling_emp_id));
			$this->scheduling_date = htmlspecialchars(strip_tags($this->scheduling_date));

			$stmt->bindParam(':scheduling_emp_id', $this->scheduling_emp_id);
			$stmt->bindParam(':scheduling_date', $this->scheduling_date);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function insertDataInScheduling() ends

		function insertDataFromExcel()
		{
			$query = 'INSERT INTO scheduling_table
						SET
							scheduling_emp_id=:scheduling_emp_id,
							scheduling_date=:scheduling_date,
							scheduling_from=:scheduling_from,
							scheduling_to=:scheduling_to';

			$stmt = $this->conn->prepare($query);

			$this->scheduling_emp_id = htmlspecialchars(strip_tags($this->scheduling_emp_id));
			$this->scheduling_date = htmlspecialchars(strip_tags($this->scheduling_date));
			$this->scheduling_from = htmlspecialchars(strip_tags($this->scheduling_from));
			$this->scheduling_to = htmlspecialchars(strip_tags($this->scheduling_to));

			$stmt->bindParam(':scheduling_emp_id', $this->scheduling_emp_id);
			$stmt->bindParam(':scheduling_date', $this->scheduling_date);
			$stmt->bindParam(':scheduling_from', $this->scheduling_from);
			$stmt->bindParam(':scheduling_to', $this->scheduling_to);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function insertDataFromExcel() ends

		function insertSched()
		{
			$query = 'INSERT INTO schedule_table
						SET
							schedule_id=:schedule_id,
							schedule_time_from=:schedule_time_from,
							schedule_time_to=:schedule_time_to,
							schedule_task_list_id=:schedule_task_list_id';

			$stmt = $this->conn->prepare($query);

			$this->schedule_id = htmlspecialchars(strip_tags($this->schedule_id));
			$this->schedule_time_from = htmlspecialchars(strip_tags($this->schedule_time_from));
			$this->schedule_time_to = htmlspecialchars(strip_tags($this->schedule_time_to));
			$this->schedule_task_list_id = htmlspecialchars(strip_tags($this->schedule_task_list_id));

			$stmt->bindParam(':schedule_id', $this->schedule_id);
			$stmt->bindParam(':schedule_task_list_id', $this->schedule_task_list_id);
			$stmt->bindParam(':schedule_time_from', $this->schedule_time_from);
			$stmt->bindParam(':schedule_time_to', $this->schedule_time_to);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getAllEmployeeInDateSched($date)
		{
			$query = "SELECT `scheduling_emp_id`, `scheduling_id`
						FROM `scheduling_table`
						WHERE `scheduling_date` = '$date'
						GROUP BY `scheduling_emp_id`";

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

		function getAllEmployeeInTimeSched($time, $id)
		{
			$query = "SELECT `schedule_id`
						FROM `schedule_table`
						WHERE `schedule_id` = '$id'
						AND `schedule_time_from` = '$time'
						GROUP BY `schedule_id`";

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

		function addEmployeeToSched()
		{
			$query = 'INSERT INTO schedule_table
						SET
							schedule_id=:schedule_id,
							schedule_time_from=:schedule_time_from,
							schedule_time_to=:schedule_time_to,
							schedule_task_list_id=:schedule_task_list_id';

			$stmt = $this->conn->prepare($query);

			$this->schedule_id = htmlspecialchars(strip_tags($this->schedule_id));
			$this->schedule_time_from = htmlspecialchars(strip_tags($this->schedule_time_from));
			$this->schedule_time_to = htmlspecialchars(strip_tags($this->schedule_time_to));
			$this->schedule_task_list_id = htmlspecialchars(strip_tags($this->schedule_task_list_id));

			$stmt->bindParam(':schedule_id', $this->schedule_id);
			$stmt->bindParam(':schedule_task_list_id', $this->schedule_task_list_id);
			$stmt->bindParam(':schedule_time_from', $this->schedule_time_from);
			$stmt->bindParam(':schedule_time_to', $this->schedule_time_to);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function editEmployeeToSched($schedid, $sched_id, $task_id, $time_from, $time_to)
		{
			$query = "UPDATE `schedule_table`
						SET `schedule_id` = '$schedid'
						WHERE `schedule_id` = '$sched_id'
						AND `schedule_task_list_id` = '$task_id'
						AND `schedule_time_from` = '$time_from'
						AND `schedule_time_to` = '$time_to'";

			$stmt = $this->conn->prepare($query);

			$this->schedule_id = htmlspecialchars(strip_tags($this->schedule_id));

			$stmt->bindParam(':schedule_id', $this->schedule_id);
			
			if($stmt->execute())
			{
				header("location: ../../../render/supervisor/body/scheduling.php");
			}
			else
			{
				return false;
			}
		} //function ends

		function getIdOfTimeFrom($id, $taskid, $time_from)
		{
			$query = "SELECT `schedule_id`
						FROM `schedule_table`
						WHERE `schedule_time_from` = '$time_from'
						AND `schedule_id` = '$id'
						AND `schedule_task_list_id` = '$taskid'";

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

		function getMaxDate()
		{
			$query = "SELECT MAX(scheduling_date) as maxdate
						FROM `scheduling_table`";

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
		
		function getIdOfScheduledToday($date)
		{
			$query = "SELECT `scheduling_emp_id`
						FROM `scheduling_table`
						WHERE `scheduling_date` = '$date'
						GROUP BY `scheduling_emp_id`";

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

		function getScheduleUsingSchedId($scheduling_id)
		{
			$query = "SELECT *
						FROM `schedule_table`
						WHERE `schedule_id` = '$scheduling_id'";

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
