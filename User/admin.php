<?php require("adminController.php"); session_start(); ?>

<!DOCTYPE html>
<html>
    <title>Admin</title>
    <head>
        <?php include("../Global/head.php"); ?>
        <script type="text/javascript" src="../Script/admin.js"></script>
        <p id="navBarActive" hidden>adminPage</p>
    </head>
    
    <body>
        <?php include("../Global/navBar.php"); ?>
        <?php if (!isset($_SESSION['userLoggedIn']) || $userLoggedIn->getLevel() < 3) header("Location: ../Global/forbidden.php"); ?>

    <div class="container d-flex justify-content-center">
        <form class="form-inline my-2 my-lg-0">
            <input id="adminSearchBar" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        </form>
        <select id="adminSelect" class="form-control w-auto">
            <option>In-Active</option>
            <option>Active</option>
        </select>
    </div>
        <div class="container pt-4" id="adminContainer">
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