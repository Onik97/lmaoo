<?php include_once(__DIR__ . "/../../includes/autoloader.inc.php");

// TODO: Create better solution for this if statement below -> Ticket ID: 
if (isset($_POST['projectId']) && isset($_POST['progress']))
{
    Validator::validateDeveloper();
    echo json_encode(ProjectController::getTicketListWithProgress(@$_POST['projectId'], @$_POST['progress']));
}

try
{
    if (!Validator::validateUserLoggedIn()) { http_response_code(401); return; }
    RouteController::Post("loadProjects", Validator::validateDeveloper(), 'ProjectController::getProjectList', array());
    RouteController::Post("createProject", Validator::validateDeveloper(), 'HomeController::createNewProject', [@$_POST['projectName'], @$_POST['projectStatus']]);
    RouteController::Post("createTicket", Validator::validateDeveloper(), 'ProjectController::createNewTicket', [@$_POST['projectId'], @$_POST['summary'], @$_POST['reporterKey']]);
    RouteController::Post("checkProjectExistance", Validator::validateDeveloper(), 'ProjectController::projectExistance', [@$_POST['name']]);
    Validator::ThrowNotFound();
}
catch(Throwable $e)
{
    http_response_code(500);
}