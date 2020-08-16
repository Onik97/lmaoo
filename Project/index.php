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

            <ul class="nav nav-tabs nav-fill" id="projectProgressTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="open-tab" data-toggle="tab" href="#open-content" role="tab">Open</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#progress-content" role="tab">In-Progress</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="automation-tab" data-toggle="tab" href="#automation-content" role="tab">In-Automation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="complete-tab" data-toggle="tab" href="#complete-content" role="tab">Complete</a>
              </li>
            </ul>
            
            <table id="ticketTable" class="table">
              <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-home-tab">
                    <thead>
                      <tr>
                        <th class="col1" scope="col">Ticket ID</th>
                        <th class="col2" scope="col">Summary</th>
                        <th class="col3" scope="col">Progress</th>
                        <th class="col4" scope="col">Assignee</th>
                      </tr>
                    </thead>
            </table>

            <div id="ticketBtnDiv"></div>
          </div>
      </div>
    </div>

    <button onclick="ticketswithprogress()">test</button>

    <?php include("projectModal.php"); ?>
    <?php include("../Global/editUserModal.php"); ?>
  </body>
</html>