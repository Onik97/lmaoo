<?php include_once "../../vendor/autoload.php";

use Lmaoo\Core\Middleware;
use Lmaoo\Core\Render;

use Lmaoo\Controller\AdminController;
use Lmaoo\Controller\GithubController;
use Lmaoo\Controller\ManagerController;
use Lmaoo\Controller\ProjectController;
use Lmaoo\Controller\FeatureController;
use Lmaoo\Controller\TicketController;
use Lmaoo\Controller\UserController;

if (session_status() == PHP_SESSION_NONE) session_start();

// Documentation: https://github.com/bramus/router
$router = new Bramus\Router\Router();
$json = file_get_contents("php://input");

// Secure all Endpoints using Middleware
$router->before("GET|POST", "/profile.*", fn() => Middleware::verifyUser($router, 1));
$router->before("GET|POST", "/project.*", fn() => Middleware::verifyUser($router, 1));
$router->before("GET|POST", "/ticket.*", fn() => Middleware::verifyUser($router, 1));
$router->before("GET|POST", "/manager.*", fn() => Middleware::verifyUser($router, 2));
$router->before("GET|POST", "/admin.*", fn() => Middleware::verifyUser($router, 4));
$router->before("GET|POST", "/feature.*", fn() => Middleware::verifyUser($router, 2));
$router->before("POST", "/project.*", fn() => Middleware::verifyJson($router, $json));
$router->before("POST", "/manager.*", fn() => Middleware::verifyJson($router, $json));
$router->before("POST", "/admin.*", fn() => Middleware::verifyJson($router, $json));
$router->before("POST", "/feature.*", fn() => Middleware::verifyJson($router, $json));
$router->before("POST", "/profile*", fn() => Middleware::verifyJson($router, $json));

// Set 404 Page
$router->set404("Lmaoo\Core\Render::NotFound");

// Non-secure routes
$router->get("/", fn() => Render::index());
$router->get("/login", fn() => Render::login());
$router->get("/register", fn() => Render::register());
$router->post("/login", fn() => (new UserController)->standardLogin());
$router->post("/register", fn() => (new UserController)->register());
$router->get("/logout", fn() => (new UserController)->logout());

// All /project requests
$router->mount("/project", function() use ($router, $json)
{
    $router->get("/(\d+)", fn($projectId) => Render::project($projectId));
    $router->post("/", fn() => (new ProjectController)->createProject($json));
    $router->put("/", fn() => ProjectController::updateProject());

    $router->get("/activate/(\d+)", fn($projectId) => ProjectController::activateProject($projectId));
    $router->get("/deactivate/(\d+)", fn($projectId) => ProjectController::deactivateProject($projectId));

});

// All /feature requests

$router->mount("/feature", function() use ($router, $json)
{
    $router->post("/", fn() => FeatureController::createFeature($json));
    $router->put("/", fn() => FeatureController::updateFeatures($json));

    $router->put("/(\d+)", fn($featureId) => FeatureController::activateFeature($featureId));
    $router->delete("/(\d+)", fn($featureId) => FeatureController::deactivateFeature($featureId));
});

// All /manager requests
$router->mount("/manager", function() use ($router, $json)
{
    $router->get("/", fn() => Render::manager());

    $router->post("/", fn() => ManagerController::createUsersToProject($json));

    $router->delete("/project/(\d+)", fn($projectId) => ManagerController::deleteUsersFromProject($projectId));
});

// All /manager requests
$router->mount("/ticket", function() use ($router, $json)
{
    $router->get("/(\d+)", fn($ticketId) => Render::ticket($ticketId));
    $router->post("/", fn() => (new TicketController)->createTicket($json));
    $router->put("/", fn() => (new TicketController)->updateTicket($json));
    
    $router->get("/assignee", fn() => (new TicketController)->getAssignees());

    $router->mount("/comment", function() use ($router, $json)
    {
        $router->post("/", fn() => (new TicketController)->createComment($json));
        $router->put("/", fn() => (new TicketController)->updateComment($json));
        $router->delete("/(\d+)", fn($commentId) => (new TicketController)->deleteComment($commentId));
    });
});

// All /admin requests
$router->mount("/admin", function() use ($router, $json)
{
    $router->get("/", fn() => Render::admin());
    
    $router->get("/user/id/(\d+)", fn($userId) => AdminController::readUserWithId($userId));
    $router->get("/user/active", fn() => AdminController::readUserwithActive("1"));
    $router->get("/user/inactive", fn() => AdminController::readUserwithActive("0"));

    $router->put("/user", fn() => AdminController::updateUser($json));
});

// All Github OAuth
$router->mount("/github", function() use ($router)
{
    // GET github/authorize/login OR GET github/authorize/register 
    $router->get("/authorize/(\w+)", fn($function) => (new GithubController)->authorise($function));
    $router->get("/callback", fn() => (new GithubController())->callback());
});

// profile router
$router->mount("/profile", function() use ($router, $json)
{
    $router->get("/", fn() => Render::profile());
    $router->post("/", fn() => (new UserController)->updateUser());
    $router->put("/", fn() => (new UserController)->changePassword($json));
});

$router->run();
