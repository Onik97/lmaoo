<?php include_once(__DIR__ . "/../../includes/autoloader.inc.php"); 

try
{
    if (!Validator::validateUserLoggedIn()) { http_response_code(401); return; }
    RouteController::Post("loadOwnerProjects", Validator::validateDeveloper(), 'ManagerController::loadOwnerProjects', array());
    RouteController::Post("loadManagerProjects", Validator::validateDeveloper(), 'ManagerController::loadManagerProjects', array());
    RouteController::Post("removeUsersFromProject", Validator::validateDeveloper(), 'ManagerController::removeUsersFromProject', [@$_POST["projectId"]]);
    RouteController::Post("addUsersToProject", Validator::validateDeveloper(), 'ManagerController::addUsersToProject', [@$_POST["json"]]);
    RouteController::Post("loadUsersOnProject", Validator::validateDeveloper(), 'ManagerController::loadUsersOnProject', [@$_POST["projectId"]]);
    Validator::ThrowNotFound();
}
catch(Throwable $e)
{
    http_response_code(500);
}