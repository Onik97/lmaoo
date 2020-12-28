<?php error_reporting(0);
$function = $_POST['function']; include_once("User/user.php");
session_start();

function logindb($user, $password)
{
	try
	{
		$pdo = new PDO("mysql:host=192.168.5.10;dbname=lmaoo", $user, $password);
		//echo "Connection Successful";
	}
	catch(PDOException $e)
	{
		die("Error!: " . $e->getMessage() . "<br/>" . "Database not found! Connect to the VPN!");
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
