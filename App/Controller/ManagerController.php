<?php
namespace Lmaoo\Controller;

use Lmaoo\Core\Constant;
use Lmaoo\Model\Project;
use Lmaoo\Model\ProjectAccess;
use Lmaoo\Utility\Validation;
use Lmaoo\Utility\APIResponse;

class ManagerController extends BaseController
{
    public static function createUsersToProject($json)
    {
        $data = json_decode($json, true); $validation = Validation::ProgressAccess($data);

        $validation == null ? ProjectAccess::create($data): APIResponse::BadRequest($validation);
    }

    public static function readUsersOnProject($projectId)
    {
        echo json_encode(ProjectAccess::withProjectId($projectId));
    }

    public function readOwnerProjects()
    {
        return Project::read(Constant::$PROJECT_COLUMNS, array("owner" => $this->userLoggedIn->userId));
    }

    public function readManagerProjects()
    {
        return ProjectAccess::withManagerAccess($this->userLoggedIn->userId);
    }

    public static function deleteUsersFromProject($projectId)
    {
        echo json_encode(ProjectAccess::delete($projectId));
    }
}
