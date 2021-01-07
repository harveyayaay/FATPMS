<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/notification.php';

	$conn = new Database();

	$Notif = new Notification($conn->databaseConnection());

	$result_notif = $Notif->getUnreadNotifs($empid);
?>