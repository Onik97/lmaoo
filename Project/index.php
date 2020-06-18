<?php 
require("../User/user.php");
require("projectController.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<title>Home</title>
<head>
<?php include("../Global/head.php"); ?>
<link rel="stylesheet" href="../Css/projectPage.css">
<script type="text/javascript" src="../Script/projectController.js"></script>
</head>
<?php include("../Global/navBar.php"); ?>
<body>
<div class="row">
<?php if (isset($userLoggedIn)) { ?>
<script>
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var userForename = "<?php echo $userLoggedIn->getForename(); ?>";
var userSurname = "<?php echo $userLoggedIn->getSurname(); ?>";
var userLevel = "<?php echo $userLoggedIn->getLevel(); ?>";
</script>

  <div id="projectDiv" class="col-md-6 bg-primary">
  </div>

  <div id="tickets" class="col-md-6 bg-info">
    <h1 id="ticketMessage">Tickets</h1>
    <div id="ticketBtnDiv"></div>
    <div id=ticketDiv></div>
  </div>

</div>

<?php include("projectModal.php"); ?>

<?php } else {
  session_start();
  $_SESSION['message'] = "Login Required to access Project Page";
} ?>

</body>
</html>
<?php include("../Global/editUserModal.php"); 
?>