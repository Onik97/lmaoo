<?php include_once(__DIR__ . "/../../includes/autoloader.inc.php");

try
{
    if (!Validator::validateUserLoggedIn()) { http_response_code(401); return; }
    RouteController::Post("loadTicketsWithDeadline", Validator::validateDeveloper(), HomeController::loadTicketsWithDeadline());
    RouteController::Post("loadOwnProjects", Validator::validateDeveloper(), HomeController::loadOwnProjects());
    Validator::ThrowNotFound();
}
catch(Throwable $e)
{
    http_response_code(500);
}