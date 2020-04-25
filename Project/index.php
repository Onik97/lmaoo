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
<?php if (isset($userLoggedIn)) { ?>
<script>
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var userForename = "<?php echo $userLoggedIn->getForename(); ?>";
var userSurname = "<?php echo $userLoggedIn->getSurname(); ?>";
var userLevel = "<?php echo $userLoggedIn->getLevel(); ?>";
</script>

<div class="wrapper">
<div id="projectDiv">

</div>
  <div id="createProject"></div>
  <div class="content">
    <div id="ticketDiv">
        <h1 id="ticketMessage">Tickets</h1>
        <div id="ticketBtnDiv"></div>
      </div>
  </div>
</div>

<?php include("projectModal.php"); ?>

<?php } else {
	echo "<p> You need to login to access this page </p>";
} ?>

</body>
</html>
<?php include("../Global/editUserModal.php"); 
?>