<?php require("../User/user.php");
session_start();
if(isset($_SESSION['userLoggedIn'])){header("Location: ../Ticket/index.php");}
?>
<!DOCTYPE html>
<html>
<title>Login</title>
<head>
<?php include("../Global/head.php"); ?>
</head>
<p id="navBarActive" hidden>loginPage</p>
<?php include("../Global/navBar.php"); ?>
<head>
<link rel="stylesheet" href="../Css/UserPage.css">
</head>
<body>
<div class="top-buffer">
	<div class="container">
		<form action="userController.php" method='POST'>
			Username:<br>
		<input type="text" name="username" id="usernameLogin" required> <br>
			Password:<br>
		<input type="password" name="password" id="passwordLogin" required>
		<input type="hidden" name="function" value="login">
		<input class="one" type="submit" value="Submit"> <br><br>
		<a href="../User/register.php">Not Registered? Click here!</a>
		</form>
	</div>
</div>
	<?php 
	if (isset($_SESSION['message']))
	{ ?>
		<div class="alert alert-warning"> <?php
		echo $_SESSION['message'];session_unset(); ?>
  		</div><?php
	} ?>
</body>
</html>