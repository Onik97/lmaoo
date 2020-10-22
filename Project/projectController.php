<?php
require_once(__DIR__ . "/../connection.php");
require_once(__DIR__ . "/../User/user.php");

$projectController = new projectController();

if ($_GET['projectId'] && $_GET['progress'])
{
    echo json_encode($projectController->getTicketListWithProgress($_GET['projectId'], $_GET['progress']));
}
else if($_POST['function'] == "loadProjects")
{
    echo json_encode($projectController->getProjectList());
}
else if($_POST['function'] == "createProject")
{
    $projectController->createNewProject($_POST['projectName'], $_POST['projectStatus']);
}
else if($_POST['function'] == "createTicket")
{
    $projectController->createNewTicket($_POST['projectId'], $_POST['summary'], $_POST['reporterKey']);
}
else if ($_POST['function'] == "checkProjectExistance")
{
    echo $projectController->projectExistance(null);
}
else
{
    ob_end_clean();
    header('HTTP/1.0 404 Not Found');
}

class projectController
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

        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$projectSearch]);

        if($stmt->rowCount() != 0) return true; 

        return false;
    }

    public function createNewProject($projectName, $projectStatus)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("INSERT INTO project (name, status) VALUES (?, ?)");
        $stmt->execute([$projectName, $projectStatus]);
    }

    public function createNewTicket($featureId, $summary, $reporterKey)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("INSERT INTO ticket (summary, featureId, reporter_key) VALUES (?, ?, ?)");
        $stmt->execute([$summary, $featureId, $reporterKey]);
    }

    public function getProjectList()
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT projectId, name, status FROM project");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTicketListWithProgress($featureId, $progress)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT ticket.ticketId, ticket.summary, ticket.progress, user.forename, user.surname 
                            FROM ticket LEFT JOIN user on user.userId = ticket.assignee_key
                            WHERE featureId = ? AND ticket.progress = ?");
        $stmt->execute([$featureId, $progress]);
        return $stmt->fetchAll();
    }

    public function loadProjectsInNavBar()
    {
        $projectController = new projectController();
        if (!isset($_SESSION["userLoggedIn"])) { return; }
        $projects = $projectController->getProjectList();
        ?> 
        <li class="nav-item dropdown">
            <a id="projectNav" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Project<span class="caret"></span></a>

            <div class="dropdown-menu">
                <?php $userLoggedIn = $_SESSION['userLoggedIn'];
                if ($userLoggedIn->getLevel() > 3)
                { ?>
                <a class="dropdown-item" data-toggle="modal" data-target="#globalModal" onclick="createProjectPrompt()">+ Create Project</a>
                <?php }
                foreach ($projects as $project) 
                { ?>
                <a class="dropdown-item" href="../Project/index.php?projectId=<?php echo $project->projectId ?>"><?php echo $project->name ?></a>
                <?php } ?>
            </div>
        </li>
        <?php
    }
}
?>