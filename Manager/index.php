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

    <h1>Manager Dashboard</h1>

    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <h3 href="#">Projects <span class="badge">42</span></h3>

            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-success">New Project</button>
            </div>
        </div>

        
        <!-- Projects List -->

           <hr> <ul class="list-group list-group-flush project-list">
                <li class="list-group-item">
                    <div class="project-info">Project 1

                        <div class="project-status">In progress</div>

                        <div class="owner-role">
                            <span class="user-access-role d-block">Owner</span>
                        </div>

                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#managerModal">Roles</button>
                    </div>
                </li>

                <li class="list-group-item justify-content-between">
                    <div class="project-info">Project 2

                        <div class="project-status">Back-log</div>

                        <div class="manager-role">
                            <span class="user-access-role d-block">Manager</span>
                        </div>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#managerModal">Roles</button>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="project-info">Project 3

                        <div class="project-status">In development</div>

                        <div class="manager-role">
                            <span class="user-access-role d-block">Manager</span>
                        </div>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#managerModal">Roles</button>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="project-info">Project 4

                        <div class="project-status">Completed</div>

                        <div class="manager-role">
                            <span class="user-access-role d-block">Manager</span>
                        </div>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#managerModal">Roles</button>
                    </div>
                </li>
            </ul>
    </div>

    <?php include("../Global/scripts.php"); ?>
    <?php include("managerModal.php"); ?>
    <script type="text/javascript" src="../Script/managerController.js"></script>
</body>
</html>