<?php include_once "../../vendor/autoload.php";

use Lmaoo\Core\Middleware;

if (session_status() == PHP_SESSION_NONE) session_start();

// Documentation: https://github.com/bramus/router
$router = new Bramus\Router\Router();
$json = file_get_contents('php://input'); // Need to find a better way to handle this

// Secure all Endpoints using Middleware
$router->before('GET|POST', '/project.*', fn() => Middleware::verifyUser($router, 1));
$router->before('GET|POST', '/manager.*', fn() => Middleware::verifyUser($router, 2));
$router->before('GET|POST', '/admin.*', fn() => Middleware::verifyUser($router, 4));
$router->before('POST', '/project.*', fn() => Middleware::verifyJson($router, $json));
$router->before('POST', '/manager.*', fn() => Middleware::verifyJson($router, $json));
$router->before('POST', '/admin.*', fn() => Middleware::verifyJson($router, $json));

// Set 404 Page
$router->set404("Lmaoo\Core\Render::NotFound");

// Non-secure routes
$router->get('/', "Lmaoo\Core\Render::index" );
$router->get('/register', "Lmaoo\Core\Render::register" );
$router->get('/login', "Lmaoo\Core\Render::login" );
$router->post('/login', "Lmaoo\Controller\UserController::standardLogin" );
$router->get('/logout', "Lmaoo\Controller\UserController::logout" );

// All /project requests
$router->mount('/project', function() use ($router)
{
    $router->get('/', "Lmaoo\Core\Render::project");
});

// All /manager requests
$router->mount('/manager', function() use ($router)
{
    $json = file_get_contents('php://input'); // Need to find a better way to handle this

    $router->get('/', "Lmaoo\Core\Render::manager");
    $router->post("/", fn() => Lmaoo\Controller\ManagerController::addUsersToProject($json));
});

// All /admin requests
$router->mount('/admin', function() use ($router)
{
    $router->get('/', "Lmaoo\Core\Render::admin");
});

// For Testing Purposes
// $router->post("/test", fn() => Lmaoo\Controller\ManagerController::addUsersToProject(file_get_contents('php://input')));

$router->run();

// RouteController::Post("loadOwnerProjects", Validator::validateDeveloper(), 'ManagerController::loadOwnerProjects', array());
// RouteController::Post("loadManagerProjects", Validator::validateDeveloper(), 'ManagerController::loadManagerProjects', array());
// RouteController::Post("removeUsersFromProject", Validator::validateDeveloper(), 'ManagerController::removeUsersFromProject', [@$_POST["projectId"]]);
// RouteController::Post("addUsersToProject", Validator::validateDeveloper(), 'ManagerController::addUsersToProject', [@$_POST["json"]]);
// RouteController::Post("loadUsersOnProject", Validator::validateDeveloper(), 'ManagerController::loadUsersOnProject', [@$_POST["projectId"]]);

// RouteController::Post("loadTicketsWithDeadline", Validator::validateDeveloper(), 'HomeController::loadTicketsWithDeadline', array());
// RouteController::Post("loadOwnProjects", Validator::validateDeveloper(), 'HomeController::loadOwnProjects', array());

// RouteController::Post("loadProjects", Validator::validateDeveloper(), 'ProjectController::getProjectList', array());
// RouteController::Post("createProject", Validator::validateDeveloper(), 'HomeController::createNewProject', [@$_POST['projectName'], @$_POST['projectStatus']]);
// RouteController::Post("createTicket", Validator::validateDeveloper(), 'ProjectController::createNewTicket', [@$_POST['projectId'], @$_POST['summary'], @$_POST['reporterKey']]);
// RouteController::Post("checkProjectExistance", Validator::validateDeveloper(), 'ProjectController::projectExistance', [@$_POST['name']]);

// RouteController::Post("loadActiveFeatures", Validator::validateDeveloper(), 'FeatureController::loadActiveFeatures', [@$_POST['projectId']]);
// RouteController::Post("loadInactiveFeatures", Validator::validateDeveloper(), 'FeatureController::loadInactiveFeatures', [@$_POST['projectId']]);
// RouteController::Post("activateFeature", Validator::validateDeveloper(), 'FeatureController::activateFeature', [@$_POST['projectId']]);
// RouteController::Post("deactivateFeature", Validator::validateDeveloper(), 'FeatureController::deactivateFeature', [@$_POST['projectId']]);
// RouteController::Post("checkFeatureExistance", Validator::validateDeveloper(), 'FeatureController::featureExistance', [@$_POST['featureName'], @$_POST['projectId']]);
// RouteController::Post("createFeature", Validator::validateManager(), 'FeatureController::createFeature', [@$_POST['featureName'], @$_POST['projectId']]);

// RouteController::Post("checkTicket", Validator::validateDeveloper(), 'TicketController::ticketIdExistance', [@$_POST["ticketId"]]);
// RouteController::Post("checkTicketExistance", Validator::validateDeveloper(), 'TicketController::ticketExistance', [@$_POST['ticketName'], @$_POST['featureId']]);
// RouteController::Post("createComment", Validator::validateDeveloper(), 'TicketController::createComment', [@$_POST['commentContent'], @$_POST['ticketId'], @$_POST['userId']]);
// RouteController::Post("loadComments", Validator::validateDeveloper(), 'TicketController::loadComments', [@$_POST["ticketId"]]);
// RouteController::Post("updateComment", Validator::validateDeveloper(), 'TicketController::updateComment', [@$_POST['commentId'], @$_POST['commentContent']]);
// RouteController::Post("deleteComment", Validator::validateDeveloper(), 'TicketController::deleteComment', [@$_POST["commentId"]]);
// RouteController::Post("saveSelectedAssignee", Validator::validateDeveloper(), 'TicketController::saveSelectedAssignee', [@$_POST["ticketId"], @$_POST['assigneeId']]);
// RouteController::Post("assigneeSelf", Validator::validateDeveloper(), 'TicketController::assigneeYourself', [@$_POST["ticketId"], @$_POST['selfId']]);
// RouteController::Post("loadAssignee", Validator::validateDeveloper(), 'TicketController::loadAssignee', [@$_POST["ticketId"]]);
// RouteController::Post("loadReporter", Validator::validateDeveloper(), 'TicketController::loadReporter', [@$_POST["ticketId"]]);
// RouteController::Post("updateTicketTime", Validator::validateDeveloper(), 'TicketController::updateTicketTime', [@$_POST["ticketId"]]);
// RouteController::Post("loadSummary", Validator::validateDeveloper(), 'TicketController::loadSummary', [@$_POST["ticketId"]]);
// RouteController::Post("loadProgress", Validator::validateDeveloper(), 'TicketController::loadProgress', [@$_POST["ticketId"]]);
// RouteController::Post("changeProgress", Validator::validateDeveloper(), 'TicketController::changeProgress', [@$_POST['progress'], @$_POST["ticketId"]]);
// RouteController::Post("saveSummary", Validator::validateDeveloper(), 'TicketController::saveSummary', [@$_POST['summary'], @$_POST["ticketId"]]);
// RouteController::Post("loadDates", Validator::validateDeveloper(), 'TicketController::loadDates', [@$_POST["ticketId"]]);


// $function = $_POST['function'];

// if ($function == "login")
// {
// 	$userController->standardLogin($_POST['username'], $_POST['password']);
// }
// else if ($function == "register")
// {
// 	if ($userController->hasDup(null))
// 	{
//     	$_SESSION['message'] = 'Username already exist! Try logging in!';
// 		header("Location: index.php");
// 	}
// 	else
// 	{
// 		$userController->register($_POST['forename'], $_POST['surname'], $_POST['username'], $_POST['password1']);
// 	}
// }
// else if ($function == 'update')
// {
// 	Validator::validateSuperUser();
// 	$userController->updateUser($_POST['editForename'], $_POST['editSurname'], $_POST['editUsername'], $_POST['editUserId']);
// }
// else if ($function == "checkUsername")
// {
// 	$json = new stdClass();
// 	if ($userController->hasDup(null))
// 	{
// 		$json->fromServer = "True";
// 		echo json_encode($json);
// 	}
// 	else if (!$userController->hasDup(null))
// 	{
// 		$json->fromServer = "False";
// 		echo json_encode($json);
// 	}
// }
// else if ($function == "getActiveUsers") 
// {
// 	Validator::validateDeveloper();
// 	echo json_encode($userController->getActiveUsers());
// }
// else if ($function == "darkModeToggle")
// {
// 	Validator::validateDeveloper();
// 	$userController->darkModeToggle($_POST['darkMode'], $_POST['userId']);
// }
// else if ($function == "uploadProfilePic")
// {
// 	Validator::validateDeveloper();
// 	echo $userController->uploadImage($_POST['userId'], null);
// }
// else 
// {
//     Library::notFoundMessage();
// }

// $function = $_POST['function'];

// if ($function == "deactivateUser")
// {
//     $adminController->deactivateUser($_POST["userId"]);
// }
// else if ($function == "activateUser")
// {
//     $adminController->activateUser($_POST["userId"]);
// }
// else if ($function == "getAdminActiveUsers")
// {
// 	echo json_encode($adminController->getActiveUsers());
// }
// else if ($function == "getAdminInActiveUsers")
// {
// 	echo json_encode($adminController->getInActiveUsers());
// }
// else if ($function == "resetPassword")
// {
//     echo json_encode($adminController->resetPassword($_POST['userId'], null));
// }
// else if ($function == "updateUserLevel")
// {
//     ($adminController->updateUserLevel($_POST["userId"], $_POST["chosenUserLevel"]));
// }
// else 
// {
//     Library::notFoundMessage();
// }