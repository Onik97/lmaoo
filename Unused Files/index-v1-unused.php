<?php ?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/lmaoo/Css/navbar.css">
<link rel="stylesheet" href="/lmaoo/Css/Userpage.css">
</head>
<ul>
  <li><a href="/lmaoo/index.php">Home</a></li>
  <li><a href="/lmaoo/Ticket/index.php">Ticket</a></li>
  <li><a href="/lmaoo/About/index.php">About</a></li>
  <li style="float:right"><a class="active" href="">Login</a></li>
</ul>

<body>
	<form action="userController.php" method='POST'>
  Username:<br>
  <input type="text" name="loginUsername">
  <br>
  Password:<br>
  <input type="password" name="loginPassword">
  <input class="one" type="submit" value="Submit"> <br><br>
  <?php echo $message; ?>
  <a href="/lmaoo/User/register.php">Not Registered? Click here!</a>
</form> 

</body>

</html>