<?php require("../User/user.php"); require("../connection.php"); require_once("../User/userController.php"); session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <p id="navBarActive" hidden>homePage</p>
        <link rel="stylesheet" href="../Css/homePage.css">
        <?php include("../Global/head.php"); ?> 
        <?php include("../Global/navBar.php"); ?>
        <?php include("../Home/homeMessage.php"); ?> <!-- not sure what this is used for, kept just incase. -->
    </head>

    <body>

    <?php if ($userLoggedIn == null) include("aboutUs.php"); else include("dashboard.php"); ?>

    </body>
    <footer> 
        <?php include("../Global/editUserModal.php"); ?>
        <?php include("../Global/scripts.php"); ?>
    </footer>
</html>