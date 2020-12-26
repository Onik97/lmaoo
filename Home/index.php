<?php require_once("homeController.php"); ?>

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