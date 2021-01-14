<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); 

class ProjectController
{
    public function projectExistance(?string $unitTest)
    {
        if($unitTest != null) 
        { 
            $_POST['name'] = $unitTest;
            $_POST['function'] = "checkProjectExistance";
        }

        $function = $_POST['function'];
        $projectSearch = isset($function) ? $_POST['name'] : $_GET['projectId'];
        $sql = isset($function) ? "SELECT name FROM project WHERE name = ?" : "SELECT projectId FROM project WHERE projectId = ?";
        if (!isset($projectSearch) || $projectSearch == null) return false;

        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$projectSearch]);

        if($stmt->rowCount() != 0) return true; 

        return false;
    }

    public function createNewProject($projectName, $projectStatus)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("INSERT INTO project (name, status, owner) VALUES (?, ?, ?)");
        $stmt->execute([$projectName, $projectStatus, unserialize($_SESSION['userLoggedIn'])->getId()]);
    }

    public function createNewTicket($featureId, $summary, $reporterKey)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("INSERT INTO ticket (summary, featureId, reporter_key) VALUES (?, ?, ?)");
        $stmt->execute([$summary, $featureId, $reporterKey]);
    }

    public function getProjectList()
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT projectId, name, status FROM project");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTicketListWithProgress($featureId, $progress)
    {
        $sql = "SELECT ticket.ticketId, ticket.summary, ticket.progress, user.forename, user.surname 
        FROM ticket LEFT JOIN user on user.userId = ticket.assignee_key
        WHERE featureId = ? AND (ticket.progress = ?";
        // TODO: When re-writing this, ensure that a better way is used for this
        if($progress == "In Progress") $sql = $sql . "OR ticket.progress = 'In Automation')";
        else $sql = $sql .")";
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare($sql);

        $stmt->execute([$featureId, $progress]);
        return $stmt->fetchAll();
    }

    public static function loadProjectsInNavBar($userLoggedIn)
    {
        if ($userLoggedIn == null) return; 
        $projectController = new projectController();
        $projects = $projectController->getProjectList();

        echo "<li class='nav-item dropdown'>";
        echo "<a id='projectNav' href='#' class='nav-link dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Project<span class='caret'></span></a>";
        echo "<div class='dropdown-menu'>";
        
        foreach ($projects as $project) 
        { 
            echo "<a class='dropdown-item' href='../Project/index.php?projectId=$project->projectId'>$project->name</a>";
        } 
        
        echo "</div>";
        echo "</li>";
    }
}
?>