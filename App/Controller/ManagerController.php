<?php
namespace Lmaoo\Controller;

use Lmaoo\Model\Project;
use Lmaoo\Model\ProjectAccess;
use Lmaoo\Utility\Validation;
use Lmaoo\Utility\ErrorMessage;

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
        $data = json_decode($json, true); $validation = Validation::ProgressAccess($data);

        $validation == null ? ProjectAccess::create($data): ErrorMessage::BadRequest($validation);
    }

    public static function loadUsersOnProject($projectId)
    {
        echo json_encode(ProjectAccess::withProjectId($projectId));
    }
}
