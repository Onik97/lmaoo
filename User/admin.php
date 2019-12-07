<?php require("../User/userController.php"); session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Css/admin.css">
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../Script/admin.js"></script>
    <title>About</title>
</head>
<?php include("../Global/navBar.php"); ?>
<body>
    <p>This is the admin page</p>
    
    <?php if (!isset($_SESSION['userLoggedIn']) || $userLoggedIn->getLevel() == "1") 
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
                            <td>
                                <div class="btn-group btn-group-xs" role="group">
                                    <a id="<?php echo $user->userId;?>" data-toggle="modal" data-target="#function-modal" onclick="editUser(this.id)" class="btn btn-default">Edit</a> 
                                    <a id="<?php echo $user->userId;?>" data-toggle="modal" data-target="#function-modal" onclick="deleteUser(this.id)" class="btn btn-default">Delete</a> 
                                    <a id="<?php echo $user->userId;?>" data-toggle="modal" data-target="#function-modal" onclick="viewUser(this.id)" class="btn btn-default">View</a>
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