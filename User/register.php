<?php session_start(); if(isset($_SESSION['userLoggedIn'])){header("Location: ../Ticket/index.php");}?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../Css/RegisterPage.css">
 <script type="text/javascript" src="../Script/User/passwordchecker.js"></script>
 <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Register Page</title>
<head></head>
<?php include("../Global/navBar.php"); ?>
<body>
<div class="top-buffer">
	<div class="container">
  <p id=validateMessage></p>
	<form action="userController.php" onSubmit="return checkPassword(this)" method='POST'>
  Forename:<br> <input type="text" name="forename" required> <br>
  Surname:<br> <input type="text" name="surname" required> <br>
  Username:<br> <input type="text" name="username" required> <br>
  Password:<br> <input type="password" name="password1" required> <br>
  Confirm Password:<br> <input type="password" name="password2" required> <br>
  <input type="hidden" name="function" value="register">
  <input class="one" type="submit" value="Submit"> <br><br>
  <a href="../User/index.php">Register? Login here!</a>
</form>
    </div>
    </div>
</body>
</html>