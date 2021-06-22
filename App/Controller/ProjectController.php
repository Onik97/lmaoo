<?php
namespace Lmaoo\Controller;

use Lmaoo\Core\Constant;
use Lmaoo\Model\Project;
use Lmaoo\Utility\APIResponse;
use Lmaoo\Utility\Library;
use Lmaoo\Utility\Validation;

class ProjectController extends BaseController
{
    public static function createProject($json)
    {
        $data = json_decode($json, true); $validation = Validation::createProject($data);
        $validation == null ? Project::create($data) : APIResponse::BadRequest($validation);
    }

    public static function readProject($projectId, $active)
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

    public static function updateProject()
    {
        Library::validatePostValues("projectId", "name", "status", "owner");
        $data = array("name" => $_POST["name"], "status" => $_POST["status"], "owner" => $_POST["owner"]);
        Project::update($_POST["projectId"], $data);
    }

    public static function activateProject($projectId)
    {
        $data = array("active" => 1);
        
        Project::update($projectId, $data);
    }

    public static function deactivateProject($projectId)
    {
        Project::delete($projectId);
    }
}
