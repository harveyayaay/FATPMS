<?php

	class Performance
	{

		public $conn;

		public
			$performance_metric_id,
			$performance_range,
			$performance_from,
			$performance_to;

		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function insertPerformance()
		{
			$query = "INSERT INTO `performance_table`
						SET 
							performance_metric_id=:performance_metric_id,
							performance_range=:performance_range,
							performance_from=:performance_from,
							performance_to=:performance_to";

			$stmt = $this->conn->prepare($query);

			$this->performance_metric_id = htmlspecialchars(strip_tags($this->performance_metric_id));
			$this->performance_range = htmlspecialchars(strip_tags($this->performance_range));
			$this->performance_from = htmlspecialchars(strip_tags($this->performance_from));
			$this->performance_to = htmlspecialchars(strip_tags($this->performance_to));

			$stmt->bindParam(':performance_metric_id', $this->performance_metric_id);
			$stmt->bindParam(':performance_range', $this->performance_range);
			$stmt->bindParam(':performance_from', $this->performance_from);
			$stmt->bindParam(':performance_to', $this->performance_to);
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function  ends

		function updatePerformance($metric_id, $range)
		{
			$query = "UPDATE `performance_table`
						SET 
							performance_from=:performance_from,
							performance_to=:performance_to
						WHERE performance_metric_id = '$metric_id'
						AND performance_range = '$range'";

			$stmt = $this->conn->prepare($query);

			$this->performance_from = htmlspecialchars(strip_tags($this->performance_from));
			$this->performance_to = htmlspecialchars(strip_tags($this->performance_to));

			$stmt->bindParam(':performance_from', $this->performance_from);
			$stmt->bindParam(':performance_to', $this->performance_to);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function  ends

		function getPerformance($metric_id)
		{
			$query = "SELECT * 
					FROM `performance_table`
					WHERE `performance_metric_id` = '$metric_id'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function  ends
	
	} // class ends


?>
