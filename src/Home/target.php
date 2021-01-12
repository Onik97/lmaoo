<?php require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); 
$homeController = new HomeController();
$function = $_POST['function'];

if ($function == "loadTicketsWithDeadline")
{
    Validator::validateDeveloper();
    echo json_encode($homeController->loadTicketsWithDeadline());
}
else if ($function == "loadOwnProjects")
{
    Validator::validateDeveloper();
    echo json_encode($homeController->loadOwnProjects());
}
else 
{
    Library::notFoundMessage();
}