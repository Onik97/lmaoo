<?php require_once(__DIR__ . "/../connection.php"); require_once(__DIR__ . "/../User/user.php");
error_reporting(0);

$managerController = new ManagerController();
$function = $_POST['function'];

if ($function == "loadOwnerProjects") 
{
    echo json_encode($managerController->loadOwnerProjects());
}
else if ($function == "loadManagerProjects")
{
    echo json_encode($managerController->loadManagerProjects());
}
else if ($function == "removeUsersFromProject")
{
    echo json_encode($managerController->removeUsersFromProject($_POST['projectId']));
}
else if ($function == "addUsersToProject")
{
    echo json_encode($managerController->addUsersToProject($_POST['json']));
}
else if ($function == "loadUsersOnProject")
{
    echo json_encode($managerController->loadUsersOnProject($_POST['projectId']));
}

class ManagerController
{
    public function loadOwnerProjects()
    {
        session_start();
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT * FROM project WHERE owner = ?");
        $stmt->execute([$_SESSION['userLoggedIn']->getId()]);
        return $stmt->fetchAll();
    }

    public function loadManagerProjects()
    {
        session_start();
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT pa.userId, pa.projectId, p.name, p.status FROM projectAccess pa INNER JOIN project p
                               ON pa.projectId = p.projectId WHERE pa.managerAccess = 1 AND pa.userId = ?");
        $stmt->execute([$_SESSION['userLoggedIn']->getId()]);
        return $stmt->fetchAll();
    }

    public function removeUsersFromProject($projectId)
    {
        session_start();
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("DELETE FROM projectAccess WHERE userId = ?");
        $stmt->execute([$projectId]);
    }

    public function addUsersToProject($json)
    {
        $sql = "INSERT INTO projectAccess (userId, projectId, allowAccess, managerAccess) VALUES";
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            $sql = $sql . " ($value->userId, $value->projectId, $value->allowAccess, $value->managerAccess),";
        }
        $finalSql = substr($sql, 0, -1); // Removes , at the end of the SQL 

        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare($finalSql);
        $stmt->execute();
    }

    public function loadUsersOnProject($projectId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT pa.projectId, pa.managerAccess, u.userId, u.username, u.forename, u.surname FROM projectAccess pa INNER JOIN user u
                               ON pa.userId = u.userId WHERE pa.allowAccess = 1 AND projectId = ?");
        $stmt->execute([$projectId]);
        return $stmt->fetchAll();
    }
}