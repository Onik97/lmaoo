<?php 
require("../User/user.php");
require("projectController.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../Css/projectPage.css">
<script type="text/javascript" src="../Script/projectController.js"></script>
<title>Home</title>
<head>
<?php include("../Global/head.php"); ?>
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
  <a data-toggle="modal" data-target="#projectModal" role="button" onclick="createProjectPrompt()">Create Project</a>
    <h1>Projects</h1> 
    <?php $allProjects = getProjectList();
    foreach ($allProjects as $project) { ?>
    <button class="btn btn-primary" onclick="getTicketWithProjectId(this.value);getProjectName(this.innerHTML);" value="<?php echo $project->projectId ?>"> <?php echo $project->name; ?></button> <br>
    <?php } ?>
  </div>

  <div id="tickets" class="col-md-6 bg-info">
    <h1 id="ticketMessage">Tickets</h1>
    <div id=ticketDiv></div>
  </div>

</div>

<?php include("projectModal.php"); ?>

<?php 
if(isset($_SESSION['message'])) 
{ ?>
<script>
overHang("success", "<?php echo $_SESSION['message'] ?>");
</script> <?php
}   
?>

<?php } else {
	echo "<p> You need to login to access this page </p>";
} ?>

</body>
</html>
<?php include("../Global/editUserModal.php"); 
?>