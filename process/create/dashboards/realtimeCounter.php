<?php
	$duration = $_GET['duration'];
	echo date('H:i:s', strtotime('+1 second', strtotime($duration)));
?>