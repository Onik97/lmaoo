<?php error_reporting(0);
$function = $_POST['function']; include_once("User/user.php");
session_start();

function logindb()
{
	$config = include('config.php');
	try
	{
		$pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_table']}", $config['db_username'],  $config['db_password']);
		// echo "Connection Successful";
	}
	catch(PDOException $e)
	{
		die("ERROR ID: 101");
	}
	return $pdo;
}

function validateDeveloper()
{
	if (!$_SESSION['userLoggedIn']->getLevel() >= 1)
	return null;
}

function validateManager()
{
	if (!$_SESSION['userLoggedIn']->getLevel() >= 2)
	return null;
}

function validateSuperUser()
{
	if (!$_SESSION['userLoggedIn']->getLevel() >= 3)
	return null;
}
?>
