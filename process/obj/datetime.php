<?php

	class DateTimeClass
	{
		public $conn;

		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function getTimeDiff($set_time, $duration_time)
		{
			
			$query = "SELECT TIMEDIFF('$set_time', '$duration_time') as time_diff";

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
