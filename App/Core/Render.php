<?php
namespace Lmaoo\Core;

use Lmaoo\Controller\FeatureController;
use Lmaoo\Controller\ManagerController;
use Lmaoo\Model\ProjectAccess;
use Lmaoo\Model\Ticket;
use Lmaoo\Utility\Library;
use Lmaoo\Utility\Session;

class Render
{
    public static function layout(string $view, string $file)
    {
        ob_start(); echo "<link rel='stylesheet' type='text/css' href='/Style/$file.css'/>"; $style = ob_get_clean();
        ob_start(); include_once __DIR__ . "/../View/$view.php"; $content = ob_get_clean();
        ob_start(); include_once __DIR__ . "/../View/navbar.php"; $navbar = ob_get_clean();
        ob_start(); echo "<script type='module' src='/Script/public/$file.js'></script>"; $script = ob_get_clean();
        include_once __DIR__ . "/../View/_layout.php";
    }
    
    public static function index()
    {
        $userLoggedIn = $_SESSION["userLoggedIn"] ?? null;
        $userLoggedIn == null ? self::layout("aboutUs", "home") : self::layout("dashboard", "home");
    }

    public static function login() { self::layout("login", "login"); }
    public static function register() { self::layout("register", "register"); }
    public static function manager() { self::layout("manager", "manager"); }
    public static function project() { self::layout("project", "project"); }
    public static function admin() { self::layout("admin", "admin"); }
    public static function profile() { self::layout("profile", "profile"); }

    public static function ticket($ticketId) 
    {
        $ticket = Ticket::withId($ticketId);
        if ($ticket == null) return Library::redirectWithMessage("Ticket ID not valid!", "/");
        Session::Set("ticket", $ticket);
        self::layout("ticket", "ticket");
    }

    public static function DropdownItems($userLoggedIn)
    {
        if($userLoggedIn == null)
        {
            echo "<a class='dropdown-item' id='registerNav' href='/register'>Register</a>";
            echo "<a class='dropdown-item' id='loginNav' href='/login'>Login</a>";
        }
        else
        {
            if ($userLoggedIn->level > 1) echo "<a class='dropdown-item' id='managerNav' href='/manager'>Manager</a>"; 
            echo "<a class='dropdown-item' id='editAccountNav' href='/profile' role='button'>Edit Account</a>";
            echo "<a class='dropdown-item' id='logoutNav' href='/logout'>Logout</a>";
            if($userLoggedIn->level > 3) echo "<a class='dropdown-item' id='adminNav' href='/admin'>Admin</a>";
        }
    }

    public static function ProjectsInNavBar($userLoggedIn)
    {
        if ($userLoggedIn == null) return; 
        $projects = ProjectAccess::Navbar($userLoggedIn->userId);

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

    public static function SearchBar($userLoggedIn) 
    {
        if ($userLoggedIn == null) return;

        echo "<div class='navbar-brand form-inline lg-1'>";
        echo "<input id='searchBarInput' class='form-control mr-sm-2' type='search' placeholder='Search Ticket' aria-label='Search'>";
        echo "<button id='searchBarBtn' class='btn btn-outline-success my-sm-0'>Search</button>";
        echo "</div>";
    }

    public static function Features($active)
    {
        $features = FeatureController::readFeatures($_GET["projectId"], $active);

        foreach($features as $feature)
        {
            echo "<li value='$feature->featureId'>$feature->name<i value='$feature->featureId' class='far fa-edit' data-toggle='modal' data-target='#editFeatureModal'></i></li>";
        }
    }

    public static function Projects()
    {
        $managerProjects = (new ManagerController())->readManagerProjects();
        $ownerProjects = (new ManagerController())->readOwnerProjects();

        foreach($ownerProjects as $project)
        {
            echo "<li class='list-group-item'>
                    <div class='project-info'>$project->name
                        <div class='project-status'>$project->status</div>
                        <div class='owner-role'>Owner</div>
                        <i id='editProjectIcon' class='fas fa-user-edit' data-toggle='modal' data-target='#editProjectModal' value='<?php echo $project->projectId; ?>'></i>
                    </div>
                </li>";
        }

        foreach($managerProjects as $project)
        {
            echo "<li class='list-group-item'>
                    <div class='project-info'>$project->name
                        <div class='project-status'>$project->status</div>
                        <div class='manager-role'>Manager</div>
                        <i id='editProjectIcon' class='fas fa-user-edit' data-toggle='modal' data-target='#editProjectModal' value='<?php echo $project->projectId; ?>'></i>
                    </div>
                </li>";
        }

    }

    
	public static function loadDarkModeToggle($toggle, $userLoggedIn)
	{ 
		if ($toggle == null) 
		{
			if ($userLoggedIn == null) 
			{
				$toggle = false;
				setcookie("lmaooDarkMode", false, 0, "/");
			}
			else if ($userLoggedIn != null)
			{
				$toggle = $userLoggedIn->darkMode;
				setcookie("lmaooDarkMode", $userLoggedIn->darkMode, 0, "/");
			}
		}
		
		echo "<div class='custom-control custom-switch'>";
		echo $toggle == true ? "<input type='checkbox' class='custom-control-input' id='darkModeSwitch' checked>" : "<input type='checkbox' class='custom-control-input' id='darkModeSwitch'>";
		echo "<label class='custom-control-label' for='darkModeSwitch'>Dark Mode</label>";
		echo "</div>";
	}

    public static function NotFound()
    {
        http_response_code(404);
        echo file_get_contents("../View/notFound.php");
    }
    
    public static function RedirectedMessage()
    {
        $message = $_SESSION["message"] ?? null;
        if ($message != null)
        {
            echo "<div class='alert alert-warning' role='alert'>$message</div>";
            unset($_SESSION["message"]); // Message goes after refresh
        }
    }
}
