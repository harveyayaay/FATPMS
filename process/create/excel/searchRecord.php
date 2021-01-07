<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/import.php';

	$conn = new Database();
	$Import = new Import($conn->databaseConnection());

	
	$date_search = $_POST['search_bar'];
	echo 'DATE: '.$date_search;


	include 'showFirstSample.php';
	// include 'showSecondSample.php';
?>
