<?php $_SERVER["DOCUMENT_ROOT"] . "lmaoo/config.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../../includes/head.php"); ?> 
    <link rel="stylesheet" type="text/css" href="../Css/managerPage.css"/>
    <title>Manager</title>
</head>
<body>
    <?php include("../../includes/navBar.php"); ?>

    <h1>Manager Dashboard</h1>

    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <h3 href="#">Projects <span id="projectSize" class="badge"></span></h3>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-success" data-toggle='modal' data-target='#globalModal' onclick="createProjectPrompt()">New Project</button>
            </div>
        </div>
        
        <!-- Projects List -->
        <hr><ul id="projectUl" class="list-group list-group-flush project-list"></ul>
    </div>

    <?php include("../../includes/scripts.php"); ?>
    <?php include("managerModal.php"); ?>
    <script type="text/javascript" src="../Script/managerController.js"></script>
    <?php include("../../includes/editUserModal.php"); ?>
</body>
</html>