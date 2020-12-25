<?php require("../User/user.php"); session_start(); if (isset($_SESSION['userLoggedIn'])) { header("Location: ../Ticket/index.php"); } ?>

<!DOCTYPE html>
<html>
<title>Login</title>

<head>
	<p id="navBarActive" hidden>loginPage</p>
	<link rel="stylesheet" href="../Css/Login.css">
	<?php include("../Global/head.php"); ?>
</head>

<body>
	<?php include("../Global/navBar.php");
	if (isset($_SESSION['message'])) { ?>
		<div class="alert alert-warning"> <?php
											echo $_SESSION['message'];
											session_unset(); ?>
		</div><?php
			} ?>

	<?php include("../Global/scripts.php"); ?>
</body>

</html>