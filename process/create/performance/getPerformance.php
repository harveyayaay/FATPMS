<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/performance.php';

	$conn = new Database();

	$Performance = new Performance($conn->databaseConnection());

	$result_perf = $Performance->getPerformance($metric_id);
	
?>