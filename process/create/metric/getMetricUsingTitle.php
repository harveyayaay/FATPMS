<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/metric.php';

	$conn = new Database();

	$Metric = new Metric($conn->databaseConnection());

	$result_metric = $Metric->getMetricUsingTitle($title);
	
?> 