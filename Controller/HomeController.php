<?php include("../../includes/autoloader.inc.php");

class homeController 
{
    public function loadTicketsWithDeadline()
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT ticketId, summary, progress, deadline FROM ticket WHERE assignee_key = ? ORDER BY deadline DESC");
        $stmt->execute([$_SESSION['userLoggedIn']->getId()]);
        return $stmt->fetchAll();
    }

    public function loadOwnProjects()
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT projectId, name, status FROM project WHERE owner = ?");
        $stmt->execute([$_SESSION['userLoggedIn']->getId()]);
        return $stmt->fetchAll();
    }
}

?>