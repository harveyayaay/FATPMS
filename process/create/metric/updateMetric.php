<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/metric.php';

	$conn = new Database();

	$Metric = new Metric($conn->databaseConnection());

	$Metric->metric_title = $title;
	$Metric->metric_type = $type;
	$Metric->metric_goal = $goal;

	$Metric->updateMetric($metric_id);
?>