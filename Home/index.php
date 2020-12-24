<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php require("../User/user.php"); require("../connection.php"); require("../User/userController.php"); require("homeController.php"); session_start(); ?>

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
        <script type="text/javascript" src="../Script/home.js"></script>
    </footer>
</html>