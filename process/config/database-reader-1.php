<?php

	class Database
	{
		private $dbname = 'initial_project_database_design';
		private $username = 'root';
		private $password = '';
		private $host = 'localhost';
		private $connection = null;

		function databaseConnection()
		{
			try
			{
				$this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
			}
			catch(Exception $e)
			{

			}

			return $this->connection;
		} // function end
		
	} // function class

?>
	