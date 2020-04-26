<?php
require("../User/user.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../Css/HomePage.css">
<title>Home</title>
<head>
<?php include("../Global/head.php"); ?>
</head>
<?php include("../Global/navBar.php"); ?>
<body>
<?php echo "This page is still under maintenance"; ?>
<?php include("../Global/editUserModal.php"); ?>
</body>
<p id="navBarActive" hidden>homePage</p>
<script type="text/javascript" src="../Script/navBar.js"></script>
</html>