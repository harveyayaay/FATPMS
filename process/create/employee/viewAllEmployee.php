<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/employee.php';

	$conn = new Database();

	$Employee = new Employee($conn->databaseConnection());

	$i = 0;
	echo '<div class="row">';
	$result = $Employee->getAllSupervisor();
	while($result_data = $result ->fetch( PDO::FETCH_ASSOC))
	{
		include '../../../render/manager/body/employee-management/viewAllEmployee.php';
		$getId[$i] = $result_data['employee_id'];
		++$i;
	}

	$result = $Employee->getAllFrontliner();
	while($result_data = $result ->fetch( PDO::FETCH_ASSOC))
	{
		include '../../../render/manager/body/employee-management/viewAllEmployee.php';
		$getId[$i] = $result_data['employee_id'];
		++$i;
	}
	echo '</div>';
?>