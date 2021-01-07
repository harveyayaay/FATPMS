<?php

	class Notification
	{

		public $conn;

		public
			$notif_message,
			$notif_date,
			$notif_time,
			$notif_receiver,
			$notif_status;


		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function getUnreadNotifs($empid)
		{
			$query = "SELECT * 
					FROM notif_table 
					WHERE notif_status = 'Unread'
					AND notif_receiver = '$empid'";

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

		function getReadNotifs($empid)
		{
			$query = "SELECT * 
					FROM notif_table 
					WHERE notif_status = 'Read'
					AND notif_receiver = '$empid'";

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

		function setUnreadNotifsToRead($nid, $empid)
		{
			$query = "UPDATE notif_table 
					SET notif_status = 'Read'
					WHERE notif_id = '$nid'
					AND notif_receiver = '$empid'";

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

		function countUnreadNotifs($empid)
		{
			$query = "SELECT COUNT(*) as count_notif 
					FROM notif_table 
					WHERE notif_status = 'Unread'
					AND notif_receiver = '$empid'";

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

		function addNotif()
		{
			$query = 'INSERT INTO notif_table
						SET
							notif_message=:notif_message,
							notif_date=:notif_date,
							notif_time=:notif_time,
							notif_receiver=:notif_receiver,
							notif_status=:notif_status';

			$stmt = $this->conn->prepare($query);

			$this->notif_message = htmlspecialchars(strip_tags($this->notif_message));
			$this->notif_date = htmlspecialchars(strip_tags($this->notif_date));
			$this->notif_time = htmlspecialchars(strip_tags($this->notif_time));
			$this->notif_receiver = htmlspecialchars(strip_tags($this->notif_receiver));
			$this->notif_status = htmlspecialchars(strip_tags($this->notif_status));

			$stmt->bindParam(':notif_message', $this->notif_message);
			$stmt->bindParam(':notif_date', $this->notif_date);
			$stmt->bindParam(':notif_time', $this->notif_time);
			$stmt->bindParam(':notif_receiver', $this->notif_receiver);
			$stmt->bindParam(':notif_status', $this->notif_status);

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
