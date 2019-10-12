<?php
function logindb($user, $password)
{
	$pdo;
	try
	{
		$pdo = new PDO("mysql:host=localhost;dbname=lmaoo", $user, $password);
		//echo "Connection Successful";
	}
	catch(PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		echo "lol";
	}
	return $pdo;
}
?>