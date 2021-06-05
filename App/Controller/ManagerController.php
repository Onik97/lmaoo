<?php
namespace Lmaoo\Controller;

use Lmaoo\Model\Project;
use Lmaoo\Model\ProjectAccess;
use Lmaoo\Utility\Library;
use Lmaoo\Utility\Validation;

class ManagerController extends BaseController
{
    public static function readOwnerProjects()
    {
        echo json_encode(Project::withOwnerId(self::$userLoggedIn->userId));
    }

    public static function readManagerProjects()
    {
        echo json_encode(ProjectAccess::withManagerAccess(self::$userLoggedIn->userId));
    }

    public static function removeUsersFromProject($projectId)
    {
        echo json_encode(ProjectAccess::delete($projectId));
    }

    public static function addUsersToProject($json)
    {
        // If Null means no errors
        echo Validation::ProgressAccess(json_decode($json, true)) ?? null;
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
