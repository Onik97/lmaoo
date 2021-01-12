<?php require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); session_start();
if(!isset($_SESSION['userLoggedIn'])) $_SESSION['userLoggedIn'] = null; ?>

<!DOCTYPE html>
    <head>
        <title>Home</title>
        <p id="navBarActive" hidden>homePage</p>
        <link rel="stylesheet" href="../Css/homePage.css">
        <?php include("../../includes/head.php"); ?> 
        <?php include("../../includes/navBar.php"); ?>
        <?php include("../Home/homeMessage.php"); ?> <!-- not sure what this is used for, kept just incase. -->
    </head>

    <body>

    <?php ($_SESSION['userLoggedIn'] == null) ? include("aboutUs.php") : include("dashboard.php"); ?>

    </body>
    <footer> 
        <?php if($_SESSION['userLoggedIn'] != null) include("../../includes/editUserModal.php"); ?>
        <?php include("../../includes/scripts.php"); ?>
        <script type="text/javascript" src="../Script/home.js"></script>
    </footer>
</html>