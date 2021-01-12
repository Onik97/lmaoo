<?php
class Connection 
{
	public static function logindb()
	{
		$config = include(__DIR__ . '/../config.php');
		try
		{
			$pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_table']}", $config['db_username'],  $config['db_password']);
		}
		catch(PDOException $e)
		{
			die("ERROR ID: 101");
		}
		return $pdo;
	}
}
?>