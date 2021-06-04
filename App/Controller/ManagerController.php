<?php
namespace Lmaoo\Controller;

use Lmaoo\Model\Project;
use Lmaoo\Model\ProjectAccess;
use Lmaoo\Utility\Library;

class ManagerController extends BaseController
{
    public static function readOwnerProjects()
    {
        return Project::withOwnerId(self::$userLoggedIn->userId);
    }

    public static function readManagerProjects()
    {
        return ProjectAccess::withManagerAccess(self::$userLoggedIn->userId);
    }

    public static function removeUsersFromProject($projectId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("DELETE FROM projectAccess WHERE projectId = ?");
        $stmt->execute([$projectId]);
    }

    public static function addUsersToProject($json)
    {
        $sql = "INSERT INTO projectAccess (userId, projectId, allowAccess, managerAccess) VALUES";
        $data = json_decode($json);

        foreach ($data as $value) {
            $sql = $sql . " ($value->userId, $value->projectId, $value->allowAccess, $value->managerAccess),";
        }
        $finalSql = substr($sql, 0, -1); // Removes , at the end of the SQL 

        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare($finalSql);
        $stmt->execute();
    }

    public static function loadUsersOnProject($projectId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT pa.projectId, pa.managerAccess, u.userId, u.username, u.forename, u.surname FROM projectAccess pa INNER JOIN user u
                               ON pa.userId = u.userId WHERE pa.allowAccess = 1 AND projectId = ?");
        $stmt->execute([$projectId]);
        return $stmt->fetchAll();
    }
}
