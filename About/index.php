<?php 
require("../User/user.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../Css/AboutPage.css">
<title>About</title>
<head>
<?php include("../Global/head.php"); ?>
</head>
<p id="navBarActive" hidden>aboutPage</p>
<?php include("../Global/navBar.php"); ?>
<body>
<?php echo "About page is currently on progress"; ?>
<div>
<div class="top-buffer">
<h1 class="one">Welcome to the About page</h1>
<p class="one">Our website is about project managment and organizing for all the people which are working on the project at the time.</p>
<p class="one"> We are currently working on the Main frame for our website with being able to login, Register, and write/view/delete bug tickets. </p>
</div>
</div>
<?php include("../Global/editUserModal.php"); ?>
</body>
<?php include("../Global/foot.php"); ?>
</html>