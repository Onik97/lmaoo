<?php
require('../connection.php');
error_reporting(0);
if ($_GET['projectId'] && !isset($_GET['progress']))
{
   echo json_encode(getTicketList($_GET['projectId']));
}
else if ($_GET['projectId'] && $_GET['progress'])
{
    echo json_encode(getTicketListWithProgress($_GET['projectId'], $_GET['progress']));
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
    createNewTicket($_POST['projectId'], $_POST['summary'], $_POST['reporterKey']);
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

function createNewTicket($projectId, $summary, $reporterKey)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("INSERT INTO ticket (summary, projectId, reporter_key) VALUES (?, ?, ?)");
    $stmt->execute([$summary, $projectId, $reporterKey]);
}

function getProjectList()
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT projectId, name, status FROM project");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getTicketListWithProgress($projectId, $progress)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT ticket.ticketId, ticket.summary, ticket.progress, user.forename, user.surname 
                           FROM ticket LEFT JOIN user on user.userId = ticket.assignee_key
                           WHERE projectId = ? AND ticket.progress = ?");
    $stmt->execute([$projectId, $progress]);
    return $stmt->fetchAll();
}
?>