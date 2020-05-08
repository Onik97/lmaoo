<?php require("../User/userController.php"); session_start(); ?>
<!DOCTYPE html>
<html>
<title>About</title>
<head>
<?php include("../Global/head.php"); ?>
<script type="text/javascript" src="../Script/admin.js"></script>
</head>
<p id="navBarActive" hidden>adminPage</p>
<?php include("../Global/navBar.php"); ?>
<body>
    <p>This is the admin page</p>
    
    <?php if (!isset($_SESSION['userLoggedIn']) || $userLoggedIn->getLevel() == "1" || $userLoggedIn->getLevel() == "2") 
            { header("Location: ../Global/forbidden.php"); } 
            else 
            { ?>  
                <h1>User Table</h1>
            <?php $allUsers = getAllUsers(); ?>
            <div class="container">
                <table class="table table-hover">
                    <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Forename</th>
                    <th>Surname</th>
                    <th>Level</th>
                    <th>Active</th>
                    <th>Action</th>
                    </tr>
                    <?php
                    foreach ($allUsers as $user) 
                    { ?>
                        <tr>
                            <td><?php echo $user->userId; ?></td>
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->forename; ?></td>
                            <td><?php echo $user->surname; ?></td>
                            <td><?php echo $user->level; ?></td>
                            <td><?php echo $user->isActive ?></td>
                            <td>
                                <div class="btn-group btn-group-xs" role="group">
                                    <a id="<?php echo $user->userId;?>" data-toggle="modal" data-target="#function-modal" onclick="editUser(this.id)" class="btn btn-default">Edit</a> 
                                    <a id="<?php echo $user->userId;?>" data-toggle="modal" data-target="#function-modal" onclick="deactivateUser(this.id)" class="btn btn-default">Deactivate</a> 
                                </div>
                            </td>
                        </tr>
                <?php }
            } ?>
                </table>
            </div>    
            <?php include("../Global/editUserModal.php"); ?>

<div class="modal fade" id="function-modal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>    
            <div class="modal-body">
                <div id="modalContent">
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>