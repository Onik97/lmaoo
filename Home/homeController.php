<?php require_once("../connection.php"); require_once("../User/userController.php"); session_start();
$homeController = new homeController();

if ($function == "loadTicketsWithDeadline")
{
    validateDeveloper();
    echo json_encode($homeController->loadTicketsWithDeadline());
}
else if ($function == "loadOwnProjects")
{
    validateDeveloper();
    echo json_encode($homeController->loadOwnProjects());
}

class homeController 
{
    public function loadTicketsWithDeadline()
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT ticketId, summary, progress, deadline FROM ticket WHERE assignee_key = ? ORDER BY deadline DESC");
        $stmt->execute([$_SESSION['userLoggedIn']->getId()]);
        return $stmt->fetchAll();
    }

    public function loadOwnProjects()
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT projectId, name, status FROM project WHERE owner = ?");
        $stmt->execute([$_SESSION['userLoggedIn']->getId()]);
        return $stmt->fetchAll();
    }
}

?>