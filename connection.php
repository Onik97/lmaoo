<?php
function logindb($user, $password)
{
	$pdo;
	try
	{
		$pdo = new PDO("mysql:host=192.168.2.115;dbname=lmaoo", $user, $password);
		//echo "Connection Successful";
	}
	catch(PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		//echo "lol";
	}
	return $pdo;
}

logindb("user","pass");
?>
