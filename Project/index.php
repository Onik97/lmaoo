<?php require("../User/user.php");
require("projectController.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../Css/projectPage.css">
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../Script/project.js"></script>
<title>Home</title>
<head></head>
<?php include("../Global/navBar.php"); ?>
<body>
<div class="row">
  <div id="projectDiv" class="col-md-6 bg-primary">
    <h1>Projects</h1>
    <?php $allProjects = getProjectList();
    foreach ($allProjects as $project) { ?>
    <button class="btn btn-primary" onclick="getProjectId(this.value)" value="<?php echo $project->projectId ?>"> <?php echo $project->name; ?></button> <br>
    <?php } ?>
  </div>

  <div id="ticketDiv" class="col-md-6 bg-info">
    <h1>Tickets</h1>
  </div>
</div>
</body>
</html>
<?php include("../Global/editUserModal.php"); 
// https://www.youtube.com/watch?v=ejN-oAw9vC0
?>