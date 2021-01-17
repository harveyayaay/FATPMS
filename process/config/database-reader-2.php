<?php

	class Database
	{
		private $dbname = 'u652500557_gemini';
    private $username = 'u652500557_gemini';
    private $password = 'geminiCapstone123';
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
	