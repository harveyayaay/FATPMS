<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/notification.php';

	$conn = new Database();

	$Notif = new Notification($conn->databaseConnection());

	echo $Notif->notif_message = $message;
	echo $Notif->notif_date = date('Y-m-d');
	echo $Notif->notif_time = date('H:i:s');
	echo $Notif->notif_receiver = $empid;
	echo $Notif->notif_status = 'Unread';
	echo '<br>';
	$result_notif = $Notif->addNotif();
?>