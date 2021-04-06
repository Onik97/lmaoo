<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class RenderController 
{
    public static function index(Router $router)
    {
        $userLoggedIn = $_SESSION["userLoggedIn"] ?? null;
        $userLoggedIn == null ? $router->render("aboutUs", "home") : $router->render("dashboard", "home");
    }

    public static function login(Router $router) { $router->render("login", "login"); }
	public static function register(Router $router) { $router->render("register", "register"); }
	public static function manager(Router $router) { $router->render("manager", "manager"); }
	public static function project(Router $router) { $router->render("project", "project"); }
	public static function admin(Router $router) { $router->render("admin", "admin"); }

	public static function renderDropdownItems($userLoggedIn)
	{
		$userLoggedIn = unserialize($userLoggedIn);
		if($userLoggedIn == null)
		{
			echo "<a class='dropdown-item' id='registerNav' href='/register'>Register</a>";
			echo "<a class='dropdown-item' id='loginNav' href='/login'>Login</a>";
		}
		else
		{
			if ($userLoggedIn->level > 1) echo "<a class='dropdown-item' id='managerNav' href='/manager'>Manager</a>"; 
			echo "<a class='dropdown-item' id='editAccountNav' data-toggle='modal' data-target='#view-modal' role='button'>Edit Account</a>";
			echo "<a class='dropdown-item' id='logoutNav' href='/logout'>Logout</a>";
			if($userLoggedIn->level > 3) echo "<a class='dropdown-item' id='adminNav' href='/admin'>Admin</a>";
		}
	}

	public static function renderProjectsInNavBar($userLoggedIn)
    {
        if ($userLoggedIn == null) return; 
        $projectController = new projectController();
        $projects = $projectController->getAccessibleProjectList($userLoggedIn);

        echo "<li class='nav-item dropdown'>";
        echo "<a id='projectNav' href='#' class='nav-link dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Project<span class='caret'></span></a>";
        echo "<div class='dropdown-menu'>";
        
        foreach ($projects as $project) 
        { 
            echo "<a class='dropdown-item' href='/project?projectId=$project->projectId'>$project->name</a>";
        } 
        
        echo "</div>";
        echo "</li>";
    }
}
