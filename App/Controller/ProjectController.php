<?php
namespace Lmaoo\Controller;

use Lmaoo\Model\Project;
use Lmaoo\Utility\Library;

class ProjectController
{
    public static function createProject($projectName, $projectStatus)
    {
        $data = array("name" => $projectName, "status" => $projectStatus);
        Project::create($data);
    }

    public static function readProject($projectId, $active)
    {
        $projects = Project::withId($projectId);
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
        $data = array("active" => "1");
        Project::update($projectId, $data);
    }

    public static function deactivateProject($projectId)
    {
        $data = array("active" => "0");
        Project::update($projectId, $data);
    }
}
