<?php require("../User/user.php"); require("../connection.php"); session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<style></style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../Global/head.php"); ?> 
    <link rel="stylesheet" type="text/css" href="../Css/managerPage.css"/>
    <title>Manager</title>
</head>
<body>
    <?php include("../Global/navBar.php"); ?>

    <h1>THIS IS THE MANAGER PAGE LOL</h1>

    <?php include("../Global/scripts.php"); ?>
    <?php include("managerModal.php"); ?>
    <script type="text/javascript" src="../Script/managerController.js"></script>
</body>
</html>