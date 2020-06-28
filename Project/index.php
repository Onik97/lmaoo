<?php require("../User/user.php"); require("projectController.php"); session_start(); ?>

<!DOCTYPE html>
<html>
  <title>Home</title>
    <head>
      <?php include("../Global/head.php"); ?>
      <link rel="stylesheet" href="../Css/projectPage.css">
      <script type="text/javascript" src="../Script/projectController.js"></script>
      <p id="navBarActive" hidden>projectPage</p>
    </head>

    <body>
      <?php include("../Global/navBar.php"); ?>
      <?php include("../Global/loginCheck.php"); ?>

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
            <table id="ticketTable" class="table">
                <thead>
                    <tr>
                      <th class="col1" scope="col">Ticket ID</th>
                      <th class="col2" scope="col">Summary</th>
                      <th class="col3" scope="col">Progress</th>
                      <th class="col4" scope="col">View</th>
                    </tr>
                </thead>
            </table>
            
            <div id="ticketBtnDiv"></div>
          </div>
      </div>
    </div>

    <?php include("projectModal.php"); ?>
    <?php include("../Global/editUserModal.php"); ?>
  </body>
</html>