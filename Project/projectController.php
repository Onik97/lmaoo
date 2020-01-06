<?php
require('../connection.php');
error_reporting(0);
if ($_GET['projectId'])
{
   echo json_encode(getTicketList($_GET['projectId']));
}
else if($_POST['function'] == "createTicket")
{
    createNewTicket($_POST['projectName'], $_POST['projectStatus']);
}
else 
{
    return;
}

function createNewTicket($projectName, $projectStatus)
{

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