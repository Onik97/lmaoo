<?php require("../User/user.php"); session_start(); ?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="../Css/HomePage.css">
    <title>Home</title>
    <head> 
        <?php include("../Global/head.php"); ?> 
    </head>

    <body>
        <?php include("../Global/navBar.php"); ?>
        <?php include("../Home/homeMessage.php"); ?>
        <h1>This page is under maintenance</h1>
    </body>
        
        <?php include("../Global/editUserModal.php"); ?>
</html>