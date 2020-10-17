<?php
require_once("../connection.php");
error_reporting(0);
if ($_GET['projectId'] && $_GET['progress'])
{
    echo json_encode(getTicketListWithProgress($_GET['projectId'], $_GET['progress']));
}
else if($_POST['function'] == "loadProjects")
{
    echo json_encode(getProjectList());
}
else if($_POST['function'] == "createProject")
{
    createNewProject($_POST['projectName'], $_POST['projectStatus']);
}
else if($_POST['function'] == "createTicket")
{
    createNewTicket($_POST['projectId'], $_POST['summary'], $_POST['reporterKey']);
}
else 
{
    return;
}

function projectExistance()
{
    $projectId = $_GET['projectId'];
    if (!isset($_GET['projectId']) || $_GET['projectId'] == null) return false;

    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT projectId FROM project WHERE projectId = ?");
    $stmt->execute([$projectId]);

    if($stmt->rowCount() != 0) return true; 

    return false;
}

function createNewProject($projectName, $projectStatus)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("INSERT INTO project (name, status) VALUES (?, ?)");
    $stmt->execute([$projectName, $projectStatus]);
}

function createNewTicket($featureId, $summary, $reporterKey)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("INSERT INTO ticket (summary, featureId, reporter_key) VALUES (?, ?, ?)");
    $stmt->execute([$summary, $featureId, $reporterKey]);
}

function getProjectList()
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT projectId, name, status FROM project");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getTicketListWithProgress($featureId, $progress)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT ticket.ticketId, ticket.summary, ticket.progress, user.forename, user.surname 
                           FROM ticket LEFT JOIN user on user.userId = ticket.assignee_key
                           WHERE featureId = ? AND ticket.progress = ?");
    $stmt->execute([$featureId, $progress]);
    return $stmt->fetchAll();
}

function loadProjectsInNavBar()
{
    if (!isset($_SESSION["userLoggedIn"])) { return; }
    $projects = getProjectList();
    ?> 
    <li class="nav-item dropdown">
        <a id="projectNav" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Project<span class="caret"></span></a>

        <div class="dropdown-menu">
            <?php foreach ($projects as $project) 
            { ?>
            <a class="dropdown-item" href="../Project/index.php?projectId=<?php echo $project->projectId ?>"><?php echo $project->name ?></a>
            <?php } ?>
        </div>
    </li>
    <?php
}
?>