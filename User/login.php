<?php require("../User/user.php");
session_start();
if(isset($_SESSION['userLoggedIn'])){header("Location: ../Ticket/index.php");}
?>
<!DOCTYPE HTML>
<html>
	<title>Login</title>
	<head>
		<link rel="stylesheet" href="../Css/Login.css">
		<?php include("../Global/head.php"); ?>
		<p id="navBarActive" hidden>loginPage</p>
	</head>
	
	<body>
		<?php include("../Global/navBar.php");
		if (isset($_SESSION['message']))
		{ ?>
			<div class="alert alert-warning"> <?php
			echo $_SESSION['message'];session_unset(); ?>
			</div><?php
		} ?>
		<div class="top-buffer">
			<div class="container">
				<div class="wrap">
					<form action="userController.php" method='POST'>
						<label>Username:</label>
						<input type="text" name="username" id="usernameLogin" required> <br>
						
						<label>Password:</label>
						<input type="password" name="password" id="passwordLogin" required>
						
						<input type="hidden" name="function" value="login">
						<input class="one" type="submit" value="Submit"> <br><br>
						<a href="../User/register.php">Not Registered? Click here!</a>
					</form>
				</div>	
			</div>
		</div>
	</body>
</html>