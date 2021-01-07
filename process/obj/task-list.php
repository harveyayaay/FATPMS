<?php
	class TaskList
	{

		public $conn;

		public
			$task_list_id,
			$task_list_title,
			$task_list_process_time,
			$task_list_sla,
			$task_list_importance;

		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function getTaskList($level)
		{
			$query = "SELECT *
 					FROM `task_list_table`
					WHERE `task_list_importance` = '$level'
					ORDER BY `task_list_id`";

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

		function countTaskListImportance($importance)
		{
			$query = "SELECT COUNT(*) as COUNT
					FROM `task_list_table`
					WHERE `task_list_importance` = '$importance'";

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

		function addTaskList()
		{
			$query = "INSERT INTO `task_list_table`
						SET 
							task_list_id=:task_list_id,
							task_list_title=:task_list_title,
							task_list_process_time=:task_list_process_time,
							task_list_sla=:task_list_sla,
							task_list_importance=:task_list_importance";

			$stmt = $this->conn->prepare($query);

			$this->task_list = htmlspecialchars(strip_tags($this->task_list_id));
			$this->task_list_title = htmlspecialchars(strip_tags($this->task_list_title));
			$this->task_list_process_time = htmlspecialchars(strip_tags($this->task_list_process_time));
			$this->task_list_sla = htmlspecialchars(strip_tags($this->task_list_sla));
			$this->task_list_importance = htmlspecialchars(strip_tags($this->task_list_importance));

			$stmt->bindParam(':task_list_id', $this->task_list_id);
			$stmt->bindParam(':task_list_title', $this->task_list_title);
			$stmt->bindParam(':task_list_process_time', $this->task_list_process_time);
			$stmt->bindParam(':task_list_sla', $this->task_list_sla);
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

		function updateTaskListProd()
		{
			$query = "UPDATE `task_list_table`
						SET 
							task_list_id=:task_list_id,
							task_list_title=:task_list_title,
							task_list_process_time=:task_list_process_time,
							task_list_sla=:task_list_sla,
							task_list_importance=:task_list_importance";

			$stmt = $this->conn->prepare($query);

			$this->task_list = htmlspecialchars(strip_tags($this->task_list_id));
			$this->task_list_title = htmlspecialchars(strip_tags($this->task_list_title));
			$this->task_list_process_time = htmlspecialchars(strip_tags($this->task_list_process_time));
			$this->task_list_sla = htmlspecialchars(strip_tags($this->task_list_sla));
			$this->task_list_importance = htmlspecialchars(strip_tags($this->task_list_importance));

			$stmt->bindParam(':task_list_id', $this->task_list_id);
			$stmt->bindParam(':task_list_title', $this->task_list_title);
			$stmt->bindParam(':task_list_process_time', $this->task_list_process_time);
			$stmt->bindParam(':task_list_sla', $this->task_list_sla);
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

		function getTaskListProcessingTime($task_type)
		{
			$query = "SELECT `task_list_process_time`
					FROM `task_list_table`
					WHERE `task_list_id` = '$task_type'";

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

		function getTaskListData($tid)
		{
			$query = "SELECT *
					FROM `task_list_table`
					WHERE `task_list_id` = '$tid'";

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

		function getTaskId($task_title)
		{
			$query = "SELECT `task_list_id`
					FROM `task_list_table`
					WHERE `task_list_title` = '$task_title'";

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

		function getAllProd()
		{
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

	} //class ends
?>