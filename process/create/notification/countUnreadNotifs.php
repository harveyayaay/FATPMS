<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/notification.php';

	$conn = new Database();
	$empid = $_GET['empid'];
	$Notif = new Notification($conn->databaseConnection());

	$result_notif = $Notif->countUnreadNotifs($empid);
	$result_notif_data = $result_notif->fetch(PDO::FETCH_ASSOC);
	echo $result_notif_data['count_notif'];
?>