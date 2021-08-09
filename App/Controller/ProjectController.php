<?php
namespace Lmaoo\Controller;

use Lmaoo\Core\Constant;
use Lmaoo\Model\Project;
use Lmaoo\Model\User;
use Lmaoo\Utility\APIResponse;
use Lmaoo\Utility\Library;
use Lmaoo\Utility\Validation;

class ProjectController extends BaseController
{
    public function createProject($json)
    {
        $data = json_decode($json, true); $data["owner"] = $this->userLoggedIn->userId;
        $validation = Validation::createProject($data);
        $validation == null ? Project::create($data) : APIResponse::BadRequest($validation);
    }

    public function readProject($projectId, $active)
    {
        $projects = Project::read(Constant::$PROJECT_COLUMNS, array("projectId" => $projectId));
        $returnProjects = array();
        foreach ($projects as $projects)
        {
            if ($projects->active == $active) {
                array_push($returnProjects, $projects);
            }
        }
        return $returnProjects;
    }

    public function updateProject($json)
    {
        $data = json_decode($json, true); $validation = Validation::updateProject($data);
        $projectId = $data['projectId'];
        $validation == null ? Project::update($projectId, $data) : APIResponse::BadRequest($validation);
    }

    public function activateProject($projectId)
    {
        Project::update($projectId, array("active" => 1));
    }

    public function deactivateProject($projectId)
    {
        Project::delete($projectId);
    }
}
