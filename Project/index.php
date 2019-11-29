<?php 
require("../User/user.php");
require("projectController.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../Css/projectPage.css">
<script type="text/javascript" src="../Script/project.js"></script>
<title>Home</title>
<head>
<?php include("../Global/head.php"); ?>
</head>
<?php include("../Global/navBar.php"); ?>
<body>
<div class="row">
  <div id="projectDiv" class="col-md-6 bg-primary">
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
</body>
</html>
<?php include("../Global/editUserModal.php"); 
?>