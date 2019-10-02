<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>

<form action="test.php" method="POST">	
 Password:<input type="password" name="password"> <br>
 <input class="one" type="submit" value="Submit"> <br>
</form>
</body>
</html>

<?php 
$password = $_POST['password'];
echo $password;
$hashedPassword = password_hash($password, PASSWORD_BCRYPT); 

if (password_verify($password, $hashedPassword))
{
	echo "true";
}
else
{
	echo "false";
}



	?>