<?php require("../User/userController.php"); session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Css/admin.css">
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>About</title>
</head>
<?php include("../Global/navBar.php"); ?>
<body>
    <p>This is the admin page</p>
    
    <?php if ($userLoggedIn->getLevel() == "1") 
            { ?>
                <p>403 Forbidden</p>
                <?php 
            } 
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
                                    <a href="adminController.php?edit=<?php echo $user->userId; ?>" class="btn btn-default">Edit</a> 
                                    <a href="adminController.php?delete=<?php echo $user->userId; ?>" class="btn btn-default">Delete</a> 
                                    <a href="adminController.php?view=<?php echo $user->userId; ?>" class="btn btn-default">View</a>
                                </div>
                            </td>
                        </tr>
                <?php }
            } ?>
                </table>
            </div>    
            <?php include("../Global/editUserModal.php"); ?>
</body>
</html>