<?php session_start(); if(isset($_SESSION['userLoggedIn'])){header("Location: ../Ticket/index.php");}?>
<!DOCTYPE html>
<html>
<title>Register Page</title>
<head>
<?php include("../Global/head.php"); ?>
<link rel="stylesheet" href="../Css/RegisterPage.css">
</head>
<p id="navBarActive" hidden>registerPage</p>
<?php include("../Global/navBar.php"); ?>
<body>
<div class="top-buffer">
	<div class="container">
  <p id=validateMessage></p>
	<form action="userController.php" onSubmit="return checkPassword(this)" method='POST'>
  Forename:<br> <input type="text" name="forename" id="forenameRegister" required> <br>
  Surname:<br> <input type="text" name="surname" id="surnameRegister" required> <br>
  Username:<br> <input type="text" name="username" id="usernameRegister" required> <br>
  Password:<br> <input type="password" name="password1" id="password1Register" required> <br>
  Confirm Password:<br> <input type="password" name="password2" id="password2Register" required> <br>
  <input type="hidden" name="function" value="register">
  <input class="one" type="submit" value="Submit"> <br><br>
  <a href="../User/index.php">Register? Login here!</a>
</form>
    </div>
    </div>
</body>
</html>