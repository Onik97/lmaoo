<?php session_start(); if(isset($_SESSION['userLoggedIn'])){header("Location: ../Ticket/index.php");}?>
<!DOCTYPE html>
<html>
<title>Register Page</title>
<head>
 <link rel="stylesheet" href="../Css/RegisterPage.css">
<?php include("../Global/head.php"); ?>
</head>
<p id="navBarActive" hidden>registerPage</p>
<?php include("../Global/navBar.php"); ?>

<body>
  <div class="top-buffer">
	  <div class="container">
      <div class="wrap">

	    <form action="userController.php" onSubmit="return checkPassword(this)" method='POST'>
  
      <input type="text" name="forename" id="forenameRegister" required placeholder="First Name"> 
      <input type="text" name="surname" id="surnameRegister" required placeholder="Last Name"> 
      <input type="text" name="username" id="usernameRegister" required placeholder="Username"> 
      <input type="password" name="password1" id="password1Register" required placeholder="Password"> 
      <input type="password" name="password2" id="password2Register" required placeholder="Re-Type Password"> 
      <input type="hidden" name="function" value="register">
      <input class="one" type="submit" value="Submit"> 
      <br>
      <a href="../User/index.php"> <br> Already Registered? <br>Login here!</a>
      <p id=validateMessage></p>
      </form>
      </div>
    </div>
  </div>
</body>
</html>