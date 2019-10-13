<?php require('../User/user.php'); session_start(); $message; ?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/lmaoo/Css/navbar.css"></head>
<ul>
  <li><a href="/lmaoo/index.php">Home</a></li>
  <li><a class="active" href="">Ticket</a></li>
  <li><a href="/lmaoo/About/index.php">About</a></li>
  <li style="float:right"><a href="/lmaoo/User/index.php">Login</a></li>
</ul>

<body>
<?php
if(isset($_SESSION['userLoggedIn']))
{
	$userLoggedIn = $_SESSION['userLoggedIn'];
	echo "User has been logged in"; ?> <br> <?php
	echo "Welcome " . $userLoggedIn->getForename() . " " . $userLoggedIn->getSurname();
	?>
	<form action="../User/userController.php" method="POST">
    <button type="submit" name="logout" value="logout">Logout</button>
	</form>
	<?php
}
else
{
	echo "Ticket Page is under maintenance";
}
?>
</body>

</html>