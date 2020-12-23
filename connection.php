<?php
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
?>
