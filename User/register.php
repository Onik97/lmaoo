<?php?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../Css/RegisterPage.css">
 <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Register Page</title>
<head></head>
<?php include("../Global/navBar.php"); ?>
<body>
<div class="top-buffer">
	<div class="container">
	<form action="userController.php" method='POST'>
  <input type="hidden" name="function" value="register">
  Forename:<br> <input type="text" name="forename"> <br>
  Surname:<br> <input type="text" name="surname"> <br>
  Username:<br> <input type="text" name="username"> <br>
  Password:<br> <input type="password" name="password"> <br>
  Confirm Password:<br> <input type="password" name="password2"> <br>
  <input class="one" type="submit" value="Submit"> <br><br>
  <a href="../User/index.php">Registered? Login here!</a>
</form>
    </div>
    </div>
</body>
</html>