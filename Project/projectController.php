<?php
require('../connection.php');
error_reporting(0);
if ($_GET['projectId'])
{
   echo json_encode(getTicketList($_GET['projectId']));
}
else if($_POST['function'] == "loadProjects")
{
    echo json_encode(getProjectList());
}
else if($_POST['function'] == "createProject")
{
    createNewProject($_POST['projectName'], $_POST['projectStatus']);
}
else if($_POST['function'] == "createTicket")
{
    createNewTicket($_POST['projectId'], $_POST['task'], $_POST['reporter'], $_POST['reporterKey']);
}
else 
{
    return;
}

function createNewProject($projectName, $projectStatus)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("INSERT INTO project (name, status) VALUES (?, ?)");
    $stmt->execute([$projectName, $projectStatus]);
}

function createNewTicket($projectId, $task, $reporter, $reporterKey)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("INSERT INTO ticket (ticketId, task, projectId, reporter, reporter_key) VALUES (null, ?, ?, ?, ?)");
    $stmt->execute([$task, $projectId, $reporter, $reporterKey]);
    print_r($stmt->errorInfo());
}

function getProjectList()
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT * FROM project");
    $stmt->execute();
    $projects = $stmt->fetchAll();
    return $projects;
}

function getTicketList($projectId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT * FROM ticket WHERE projectId = ?");
    $stmt->execute([$projectId]);
    $tickets = $stmt->fetchAll();
    return $tickets;
}
?>