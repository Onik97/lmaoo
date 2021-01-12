<?php require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); 

$managerController = new ManagerController();
$function = $_POST['function'];

if ($function == "loadOwnerProjects") 
{
    Validator::validateManager();
    echo json_encode($managerController->loadOwnerProjects());
}
else if ($function == "loadManagerProjects")
{
    Validator::validateManager();
    echo json_encode($managerController->loadManagerProjects());
}
else if ($function == "removeUsersFromProject")
{
    Validator::validateManager();
    echo json_encode($managerController->removeUsersFromProject($_POST['projectId']));
}
else if ($function == "addUsersToProject")
{
    Validator::validateManager();
    echo $managerController->addUsersToProject($_POST['json']);
}
else if ($function == "loadUsersOnProject")
{
    Validator::validateManager();
    echo json_encode($managerController->loadUsersOnProject($_POST['projectId']));
}
else 
{
    Library::notFoundMessage();
}