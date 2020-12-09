<?php require("../User/user.php"); require("projectController.php"); session_start(); ?>

<!DOCTYPE html>
<html>
  <title>Home</title>
    <head>
      <p id="navBarActive" hidden>projectPage</p>
      <?php include("../Global/head.php"); ?>
      <link rel="stylesheet" href="../Css/projectPage.css">
    </head>

    <body>
      <?php include("../Global/navBar.php"); ?>
      <?php include("../Global/loginCheck.php"); ?>
      <?php include("projectValidation.php") ?>

    <div class="d-flex">
      <div id="projectDiv"> 
        <nav id="sidebar">
          <div id="sidebar-header" class="sidebar-header"><h1>Features<h1></div>
          <ul id="listOfFeatures" class="list-unstyled components"></ul>
        </nav>
      </div>
      
      <div id="createProject"></div>

      <div class="content">
        <h1 id="ticketMessage">Tickets</h1>
        <p id="selectedFeatureId" hidden>0</p>
          <div id="ticketDiv">

            <ul class="nav nav-tabs nav-fill" id="projectProgressTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="open-tab" data-toggle="tab" href="#open-content" role="tab" onclick="loadTicketsWithProgress(this.innerHTML)">Open</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#progress-content" role="tab" onclick="loadTicketsWithProgress(this.innerHTML)">In Progress</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="complete-tab" data-toggle="tab" href="#complete-content" role="tab" onclick="loadTicketsWithProgress(this.innerHTML)">Complete</a>
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

    <?php include("../Global/scripts.php"); ?>
    <script type="text/javascript" src="../Script/projectController.js"></script>
    <?php include("projectModal.php"); ?>
    <?php include("../Feature/featureModal.php"); ?>
    <?php include("../Global/editUserModal.php"); ?>
  </body>
</html>