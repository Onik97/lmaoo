<?php require("../User/user.php"); require("../connection.php"); session_start(); ?>
<?php require("../User/user.php"); require("../connection.php"); require_once("../User/userController.php"); session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <p id="navBarActive" hidden>homePage</p>
        <?php include("../Global/head.php"); ?> 
    </head>

    <body>
        <?php include("../Global/navBar.php"); ?>
        <?php include("../Home/homeMessage.php"); ?>
        <h1>This page is under maintenance</h1>
        <?php include("../Global/scripts.php"); ?>
    </body>
        <?php include("../Global/editUserModal.php"); ?>

</html>