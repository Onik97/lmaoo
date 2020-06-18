<?php require("../User/user.php"); session_start(); ?>

<!DOCTYPE html>
<html>
    <head> 
        <link rel="stylesheet" href="../Css/HomePage.css">
        <p id="navBarActive" hidden>homePage</p>
        <?php include("../Global/head.php"); ?> 
        <title>Home</title>
    </head>

    <body>
        <?php include("../Global/navBar.php"); ?>
        <?php include("../Home/homeMessage.php"); ?>
        <h1>This page is under maintenance</h1>
    </body>
        <?php include("../Global/editUserModal.php"); ?>
</html>