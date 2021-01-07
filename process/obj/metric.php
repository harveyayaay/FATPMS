<?php

	class Metric
	{

		public $conn;

		public
			$metric_id,
			$metric_title,
			$metric_type,
			$metric_goal,
			$metric_reference;


		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function insertMetric()
		{
			$query = "INSERT INTO `metric_table`
						SET 
							metric_title=:metric_title,
							metric_type=:metric_type,
							metric_goal=:metric_goal,
							metric_reference=:metric_reference";

			$stmt = $this->conn->prepare($query);

			$this->metric_title = htmlspecialchars(strip_tags($this->metric_title));
			$this->metric_type = htmlspecialchars(strip_tags($this->metric_type));
			$this->metric_goal = htmlspecialchars(strip_tags($this->metric_goal));
			$this->metric_reference = htmlspecialchars(strip_tags($this->metric_reference));

			$stmt->bindParam(':metric_title', $this->metric_title);
			$stmt->bindParam(':metric_type', $this->metric_type);
			$stmt->bindParam(':metric_goal', $this->metric_goal);
			$stmt->bindParam(':metric_reference', $this->metric_reference);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function  ends

		function updateMetric($metric_id)
		{
			$query = "UPDATE `metric_table`
						SET 
							metric_title=:metric_title,
							metric_type=:metric_type,
							metric_goal=:metric_goal
						WHERE metric_id = '$metric_id'";

			$stmt = $this->conn->prepare($query);

			$this->metric_title = htmlspecialchars(strip_tags($this->metric_title));
			$this->metric_type = htmlspecialchars(strip_tags($this->metric_type));
			$this->metric_goal = htmlspecialchars(strip_tags($this->metric_goal));

			$stmt->bindParam(':metric_title', $this->metric_title);
			$stmt->bindParam(':metric_type', $this->metric_type);
			$stmt->bindParam(':metric_goal', $this->metric_goal);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function  ends

		function getAllMetric()
		{
			$query = "SELECT * 
					FROM `metric_table`";

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

		function getMetricUsingId($metric_id)
		{
			$query = "SELECT * 
					FROM `metric_table`
					WHERE `metric_id` = '$metric_id'";

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

		function getMetricUsingTitle($title)
		{
			$query = "SELECT * 
					FROM `metric_table`
					WHERE `metric_title` = '$title'";

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
