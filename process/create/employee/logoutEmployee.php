<?php

	session_start();
	if(session_destroy())
	{
		header("location: ../../../render/login/login.php");
	}
	else
	{

		echo "session not destroyed";
	}
?>