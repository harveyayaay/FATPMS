<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/performance.php';

	$conn = new Database();
	
	$Performance = new Performance($conn->databaseConnection());

	$Performance->performance_from = $update_range0;
	$Performance->performance_to = $update_range1;
	$Performance->updatePerformance($metric_id, '3');

	$Performance->performance_from = $update_range2;
	$Performance->performance_to = $update_range3;
	$Performance->updatePerformance($metric_id, '2.5');

	$Performance->performance_from = $update_range4;
	$Performance->performance_to = $update_range5;
	$Performance->updatePerformance($metric_id, '2');

	$Performance->performance_from = $update_range6;
	$Performance->performance_to = $update_range7;
	$Performance->updatePerformance($metric_id, '1.5');

	$Performance->performance_from = $update_range8;
	$Performance->performance_to = $update_range9;
	$Performance->updatePerformance($metric_id, '1');
	
?>