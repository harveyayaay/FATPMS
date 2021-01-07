<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/notification.php';

	$conn = new Database();

	$Notif = new Notification($conn->databaseConnection());
	$nid = $_GET['nid'];
	$empid = $_GET['empid'];
	$result_notif = $Notif->setUnreadNotifsToRead($nid, $empid);
	header('location: ../../../render/frontliner/body/schedule.php');
?>