<?php

	class Import
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
			$schedule_task_type,
			$schedule_importance,
			$schedule_quantity;



		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function getScheduledEmployee($date_search)
		{
			$query = "SELECT *
						FROM `scheduling_table`
						WHERE `scheduling_date` = '$date_search'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getScheduledEmployee ends

		function getIdFromDate($date_search)
		{
			$query = "SELECT `scheduling_emp_id`
						FROM `scheduling_table`
						WHERE `scheduling_date` = '$date_search'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getIdFromDate() ends

		function checkIfCurrentTimeExist($date_search)
		{
			$query = "SELECT *
						FROM `scheduling_table`
						WHERE `scheduling_date` = '$date_search'";

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

		function getOpener($date_search)
		{
			$query = "SELECT *
						FROM `scheduling_table`
						WHERE `scheduling_date` = '$date_search'
						AND `scheduling_from` < '12:00:00'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function countOpener() ends

		function getCloser($date_search)
		{
			$query = "SELECT *
						FROM `scheduling_table`
						WHERE `scheduling_date` = '$date_search'
						AND `scheduling_from` > '11:59:59'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function countCloser() ends

	} // class ends


?>
