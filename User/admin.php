<?php require("../User/userController.php"); session_start(); ?>

<!DOCTYPE html>
<html>
    <title>Admin</title>
    <head>
        <?php include("../Global/head.php"); ?>
        <link rel="stylesheet" href="../Css/admin.css">
        <script type="text/javascript" src="../Script/admin.js"></script>
        <p id="navBarActive" hidden>adminPage</p>
    </head>
    
    <body>
        <?php include("../Global/navBar.php"); ?>
        <?php if (!isset($_SESSION['userLoggedIn']) || $userLoggedIn->getLevel() < 3) header("Location: ../Global/forbidden.php"); ?>

        <div class="container" id="adminContainer">
            <table class="table table-hover" id="admin-table">
                <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Forename</th>
                <th>Surname</th>
                <th>Level</th>
                <th>Active</th>
                <th>Action</th>
                </tr>
            </table>
        </div>    
                
        <?php include("../Global/editUserModal.php"); ?>
        <?php include("adminModal.php"); ?>
    </body>

</html>