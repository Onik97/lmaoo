<?php require("adminController.php"); session_start(); ?>

<!DOCTYPE html>
<title>Admin</title>

<head>
    <p id="navBarActive" hidden>adminPage</p>
    <?php include("../Global/head.php"); ?>
    <link rel="stylesheet" href="../Css/admin.css">
</head>

<body>
    <?php include("../Global/navBar.php"); ?>
    <?php if (!isset($_SESSION['userLoggedIn']) || $userLoggedIn->getLevel() < 3) header("Location: ../Global/forbidden.php"); ?>

    <div class="container d-flex justify-content-center">
        <form class="form-inline my-2 my-lg-0">
            <input id="adminSearchBar" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        </form>
        <select id="adminSelect" class="form-control w-auto" onchange="activeSelect(this.value)">
            <option value="Active">Active</option>
            <option value="inActive">In-Active</option>
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
                <th>Action</th>
            </tr>
        </table>
    </div>

    <?php include("../Global/scripts.php"); ?>
    <?php include("../Global/editUserModal.php"); ?>
    <?php include("adminModal.php"); ?>
    <script type="text/javascript" src="../Script/admin.js"></script>
</body>

</html>