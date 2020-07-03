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
          

            <ul class="nav nav-tabs" id="projectTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="comment-tab" data-toggle="tab" href="#comment-content" role="tab" aria-controls="home" aria-selected="true">All</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes-content" role="tab" aria-controls="profile" aria-selected="false">Assigned to Me</a>
              </li>
            </ul>
            
            <table id="ticketTable" class="table">
              <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-home-tab">
                <ul class="nav nav-tabs nav-fill" id="projectProgressTab">
                  <li class="nav-item">
                    <a class="nav-link active" id="open-tab" data-toggle="tab" href="#open-content" role="tab">Open</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="in-progress-tab" data-toggle="tab" href="in-progress-content" role="tab">In-progress</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="in-automation-tab" data-toggle="tab" href="#in-automation-content" role="tab">In Automation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed-content" role="tab">Completed</a>
                  </li>
                </ul>
            <div id="ticketBtnDiv"></div>
          </div>
      </div>
    </div>

    <?php include("projectModal.php"); ?>
    <?php include("../Global/editUserModal.php"); ?>
  </body>
</html>

<!-- 
<table>
  <thead>
    <tr>
      <th class="col1" scope="col">Ticket ID</th>
      <th class="col2" scope="col">Summary</th>
      <th class="col3" scope="col">Progress</th>
      <th class="col4" scope="col">Assignee</th>
    </tr>
</thead>
</table>  // left this here for when we need it.
-->