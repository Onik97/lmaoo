<?php require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); 

$projectController = new projectController();

if ($_POST['projectId'] && $_POST['progress'])
{
    Validator::validateDeveloper();
    echo json_encode($projectController->getTicketListWithProgress($_POST['projectId'], $_POST['progress']));
}
else if($_POST['function'] == "loadProjects")
{
    Validator::validateDeveloper();
    echo json_encode($projectController->getProjectList());
}
else if($_POST['function'] == "createProject")
{
    Validator::validateManager();
    $projectController->createNewProject($_POST['projectName'], $_POST['projectStatus']);
}
else if($_POST['function'] == "createTicket")
{
    Validator::validateDeveloper();
    $projectController->createNewTicket($_POST['projectId'], $_POST['summary'], $_POST['reporterKey']);
}
else if ($_POST['function'] == "checkProjectExistance")
{
    Validator::validateDeveloper();
    echo $projectController->projectExistance(null);
}
else 
{
    Library::notFoundMessage();
}
