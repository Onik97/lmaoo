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
<p id="navBarActive" hidden>projectPage</p>
<?php include("../Global/navBar.php"); ?>
<body>
<?php if (isset($userLoggedIn)) { ?>
<div class="wrapper">
  <div id="projectDiv"> 
    <nav id="sidebar">
      <div id="sidebar-header" class="sidebar-header"><h1>Projects<h1></div>
      <ul id="listOfProjects" class="list-unstyled components"></ul>
    </nav>
  </div>
  
  <div id="createProject"></div>
  <div class="content">
  <h1 id="ticketMessage">Tickets</h1>
    <div id="ticketDiv">
    <div id="ticketBtnDiv"></div>
      <table id="ticketTable" class="table">
          <thead>
              <tr>
              <th class="col1" scope="col">Ticket ID</th>
              <th class="col2" scope="col">Task</th>
              <th class="col3" scope="col">Progress</th>
              <th class="col4" scope="col">View</th>
              </tr>
          </thead>
      </table>
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