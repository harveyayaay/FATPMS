<?php
	class TaskList
	{

		public $conn;

		public
			$task_list_title,
			$task_list_process_time,
			$task_list_sla,
			$task_list_importance;

		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function addTaskList()
		{
			$query = "INSERT INTO `task_list_table`
						SET 
							task_list_title=:task_list_title,
							task_list_process_time=:task_list_process_time,
							task_list_sla=:task_list_sla,
							task_list_importance=:task_list_importance";

			$stmt = $this->conn->prepare($query);

			$this->task_list_title = htmlspecialchars(strip_tags($this->task_list_title));
			$this->task_list_process_time = htmlspecialchars(strip_tags($this->task_list_process_time));
			$this->task_list_sla = htmlspecialchars(strip_tags($this->task_list_sla));
			$this->task_list_importance = htmlspecialchars(strip_tags($this->task_list_importance));

			$stmt->bindParam(':task_list_title', $this->task_list_title);
			$stmt->bindParam(':task_list_process_time', $this->task_list_process_time);
			$stmt->bindParam(':task_list_sla', $this->task_list_sla);
			$stmt->bindParam(':task_list_importance', $this->task_list_importance);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function  ends

		function updateTaskListProd($tid)
		{
			// used
			
			$query = "UPDATE `task_list_table`
						SET 
							task_list_title=:task_list_title,
							task_list_process_time=:task_list_process_time,
							task_list_sla=:task_list_sla,
							task_list_importance=:task_list_importance
						WHERE task_list_id = '$tid'";

			$stmt = $this->conn->prepare($query);

			$this->task_list_title = htmlspecialchars(strip_tags($this->task_list_title));
			$this->task_list_process_time = htmlspecialchars(strip_tags($this->task_list_process_time));
			$this->task_list_sla = htmlspecialchars(strip_tags($this->task_list_sla));
			$this->task_list_importance = htmlspecialchars(strip_tags($this->task_list_importance));

			$stmt->bindParam(':task_list_title', $this->task_list_title);
			$stmt->bindParam(':task_list_process_time', $this->task_list_process_time);
			$stmt->bindParam(':task_list_sla', $this->task_list_sla);
			$stmt->bindParam(':task_list_importance', $this->task_list_importance);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function  ends

		function updateTaskListNonProd()
		{
			$query = "UPDATE `task_list_table`
						SET 
							task_list_id=:task_list_id,
							task_list_title=:task_list_title,
							task_list_importance=:task_list_importance
						WHERE 
							task_list_id=''";

			$stmt = $this->conn->prepare($query);

			$this->task_list = htmlspecialchars(strip_tags($this->task_list_id));
			$this->task_list_title = htmlspecialchars(strip_tags($this->task_list_title));
			$this->task_list_importance = htmlspecialchars(strip_tags($this->task_list_importance));

			$stmt->bindParam(':task_list_id', $this->task_list_id);
			$stmt->bindParam(':task_list_title', $this->task_list_title);
			$stmt->bindParam(':task_list_importance', $this->task_list_importance);
			
			if($stmt->execute())
			{
				header('location: ../../../render/manager/body/tracker-management.php');
			}
			else
			{
				return false;
			}
		} //function  ends

		function getAllProd()
		{
			// used
			$query = "SELECT *
					FROM `task_list_table`
					WHERE `task_list_importance` != 'Non-Productive'";

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

		function getAllNonProd()
		{
			// used
			$query = "SELECT *
					FROM `task_list_table`
					WHERE `task_list_importance` = 'Non-Productive'";

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

		function getProdUsingTitle($title)
		{
			// used
			$query = "SELECT *
					FROM task_list_table
					WHERE task_list_importance != 'Non-Productive'
					AND task_list_title = '$title'";

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

		function getTaskListUsingId($tid)
		{
			// used
			$query = "SELECT *
					FROM task_list_table
					WHERE task_list_id = '$tid'";

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
		

	} //class ends
?>