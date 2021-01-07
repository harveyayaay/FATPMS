<?php

	class Productivity
	{

		public $conn;

		public
			$from_date,
			$to_date;


		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function getTaskList($employee_id, $date1, $date2)
		{
			$from_date = $date1.' 20:00:00'; //8pm

			if($date1 === $date2)
			{
				$to_date = $date2.' 23:59:59'; //12mn
			}
			else if($date2 === date('Y-m-d'))
			{
				$to_date = $date2.' 23:59:59'; //12mn
			}
			else
			{
				$to_date = $date2.' 00:04:00'; //4am	
			}	
			// echo $from_date .'<br>'.$to_date;
			// echo date("Y-m-d H:i:s");

			$query = "SELECT `task_type`
						FROM `task_table`
						WHERE `task_datetime` >= '$from_date' 
						AND `task_datetime` <= '$to_date' 
						AND `task_employee_id` = '$employee_id'
						GROUP BY `task_type`";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getTaskList() ends

		function getTaskAverageTime($employee_id, $date1, $date2, $type)
		{

			$from_date = $date1.' 20:00:00'; //8pm

			if($date1 === $date2)
			{
				$to_date = $date2.' 23:59:59'; //12mn
			}
			else if($date2 === date('Y-m-d'))
			{
				$to_date = $date2.' 23:59:59'; //12mn
			}
			else
			{
				$to_date = $date2.' 00:04:00'; //4am	
			}	

			$query = "SELECT AVG(`task_duration`) as average
						FROM `task_table`
						WHERE `task_datetime` >= '$from_date' 
						AND `task_datetime` <= '$to_date' 
						AND `task_employee_id` = '$employee_id' 
						AND `task_type` = '$type'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getTaskAverageTime() ends

		function countVolumeTaskType($employee_id, $date1, $date2, $type)
		{
			$from_date = $date1.' 20:00:00'; //8pm

			if($date1 === $date2)
			{
				$to_date = $date2.' 23:59:59'; //12mn
			}
			else if($date2 === date('Y-m-d'))
			{
				$to_date = $date2.' 23:59:59'; //12mn
			}
			else
			{
				$to_date = $date2.' 00:04:00'; //4am	
			}	

			$query = "SELECT COUNT(`task_type`) as count
						FROM `task_table`
						WHERE `task_datetime` >= '$from_date' 
						AND `task_datetime` <= '$to_date' 
						AND `task_employee_id` = '$employee_id' 
						AND `task_type` = '$type'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function countTaskList() ends

		// function getTaskEventTime($employee_id, $type)
		// {
		// 	$date_today = date('Y-m-d');

		// 	$query = "SELECT `task_duration`
		// 				FROM `task_table`
		// 				WHERE `task_datetime` = '$date_today' 
		// 				AND `task_employee_id` = '$employee_id' 
		// 				AND `task_type` = '$type'";

		// 	$stmt = $this->conn->prepare($query);
			
		// 	if($stmt->execute())
		// 	{
		// 		return $stmt;
		// 	}
		// 	else
		// 	{
		// 		return false;
		// 	}
		// } //function getAverageProcessTime() ends

	} // class ends


?>
