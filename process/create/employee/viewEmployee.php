<?php

	include_once '../../process/config/database.php';
	include_once '../../process/obj/registration.php';

	$conn = new Database();

	$viewEmployee = new Registration($conn->databaseConnection());

	if(!($stmt = $viewEmployee->viewSupervisor()))
	{
		echo 'Failed viewing data';	
	}
	else
	{
		$count = 0;
		while($data = $stmt->fetch( PDO::FETCH_ASSOC))
		{ 
			$count++;
		     echo $data['employee_id'].'	'; 
		     echo $data['employee_password'].'	'; 
		     echo $data['employee_fname'].'	'; 
		     echo $data['employee_mname'].'	'; 
		     echo $data['employee_lname'].'	';  
		     echo $data['employee_date_time_creation'].'	'; 
		     echo $data['employee_position_title'].'<br>';
		} //while enchant_dict_suggest(dict, word)
	}

	if(!($stmt = $viewEmployee->viewFrontliner()))
	{
		echo 'Failed viewing data';
	}
	else
	{
		$count = 0;
		while($data = $stmt->fetch( PDO::FETCH_ASSOC))
		{ 
			$count++;
		     echo $data['employee_id'].'	'; 
		     echo $data['employee_password'].'	'; 
		     echo $data['employee_fname'].'	'; 
		     echo $data['employee_mname'].'	'; 
		     echo $data['employee_lname'].'	';  
		     echo $data['employee_date_time_creation'].'	'; 
		     echo $data['employee_position_title'].'<br>';
		} //while ends
		
	}

	if($count == 0)
	{
		echo "No existing record" . "<br>";
	}

?>