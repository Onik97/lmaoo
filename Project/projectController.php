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
    createNewTicket($_POST['projectId'], $_POST['task'], $_POST['reporterKey']);
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

function createNewTicket($projectId, $task, $reporterKey)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("INSERT INTO ticket (task, projectId, reporter_key) VALUES (?, ?, ?)");
    $stmt->execute([$task, $projectId, $reporterKey]);
}

function getProjectList()
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT projectId, name, status FROM project");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getTicketList($projectId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT ticketId, summary, progress, assignee_key FROM ticket WHERE projectId = ?");
    $stmt->execute([$projectId]);
    return $stmt->fetchAll();
}
?>