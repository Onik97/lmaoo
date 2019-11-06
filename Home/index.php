<?php require("../User/user.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../Css/HomePage.css">
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Home</title>
<head></head>
<?php include("../Global/navBar.php"); ?>
<body>       
<?php echo "This message has been auto deployed"; ?>
<?php include("../Global/editUserModal.php"); ?>
</body>
</html>