<?php

	class Scorecard
	{

		public $conn;


		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function getVolumeScore($employee_id, $date1, $date2)
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
			// echo $to_date;

			$query = "SELECT COUNT(*) as count
						FROM `task_table`
						WHERE `task_datetime` >= '$from_date' 
						AND `task_datetime` <= '$to_date' 
						AND `task_employee_id` = '$employee_id'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getVolumeScore() ends

		function getAppProcessTime($employee_id, $date1, $date2)
		{
			$task_type = 'Applications';
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
			// echo $to_date;

			$query = "SELECT AVG(`task_duration`) as avg
						FROM `task_table`
						WHERE `task_datetime` >= '$from_date' 
						AND `task_datetime` <= '$to_date' 
						AND `task_employee_id` = '$employee_id'
						AND `task_type` = '$task_type'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getAppProcessTime() ends

		function getUrgentProcessTime($employee_id, $date1, $date2)
		{
			$task_type1 = 'Sales Force';
			$task_type2 = 'Skills Checklist';
			$task_type3 = 'Docu Sign';

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
			// echo $to_date;

			$query = "SELECT AVG(`task_duration`) as avg
						FROM `task_table`
						WHERE `task_datetime` >= '$from_date' 
						AND `task_datetime` <= '$to_date' 
						AND `task_employee_id` = '$employee_id'
						AND 
							(`task_type` = '$task_type1') 
							OR(`task_type` = '$task_type2') 
							OR(`task_type` = '$task_type3')";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function getAppProcessTime() ends

	} // class ends


?>
