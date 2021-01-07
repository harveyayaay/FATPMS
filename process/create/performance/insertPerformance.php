<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/performance.php';

	$conn = new Database();

	$Performance = new Performance($conn->databaseConnection());

	$Performance->performance_metric_id = $metric_id;
	$Performance->performance_range = $range;
	$Performance->performance_from = $from;
	$Performance->performance_to = $to;

	$Performance->insertPerformance();

?>		