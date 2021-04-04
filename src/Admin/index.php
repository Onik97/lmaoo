<?php include_once(__DIR__ . "/../../includes/autoloader.inc.php"); ?>

<!DOCTYPE html>
<title>Admin</title>

<head>
    <p id="navBarActive" hidden>adminPage</p>
    <?php include("../../includes/head.php"); ?>
    <link rel="stylesheet" href="../Css/admin.css">
</head>

<body>
    <?php include("../../includes/navBar.php"); ?>
    <?php if (!isset($_SESSION['userLoggedIn']) || unserialize($_SESSION['userLoggedIn'])->getLevel() < 3) header("Location: ../../includes/forbidden.php"); ?>

    <div class="container d-flex justify-content-center">
        <form class="form-inline my-2 my-lg-0">
            <input id="adminSearchBar" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        </form>
        <select id="adminSelect" class="form-control w-auto">
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

    <?php include("../../includes/scripts.php"); ?>
    <?php include("../../includes/editUserModal.php"); ?>
    <?php include("adminModal.php"); ?>
    <script type="text/javascript" src="../Script/admin.js"></script>
    <script type="module" src="../Script/public/admin.js"></script>
</body>

</html>