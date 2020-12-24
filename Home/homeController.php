<?php require("../User/user.php"); require("../connection.php"); session_start();
error_reporting(0);

$homeController = new homeController();
$function = $_POST['function'];

if ($function == "loadTicketsWithDeadline")
{
    echo json_encode($homeController->loadTicketsWithDeadline());
}
else if ($function == "loadOwnProjects")
{
    echo json_encode($homeController->loadOwnProjects());
}

class homeController 
{
    public function loadTicketsWithDeadline()
    {
        session_start();
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT ticketId, summary, progress, deadline FROM ticket WHERE assignee_key = ? ORDER BY deadline DESC");
        $stmt->execute($_SESSION['userLoggedIn']->getId());
        return $stmt->fetchAll();
    }

    public function loadOwnProjects()
    {
        session_start();
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT projectId, name, status FROM project WHERE owner = ?");
        $stmt->execute($_SESSION['userLoggedIn']->getId());
        return $stmt->fetchAll();
    }
}

?>