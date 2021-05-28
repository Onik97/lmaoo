<?php
namespace Lmaoo\Controller;

use PDO;
use Lmaoo\Model\Project;
use Lmaoo\Utility\Library;

class ProjectController
{
    public static function createProject($projectName, $projectStatus)
    {
        $data = array("name" => $projectName, "status" => $projectStatus);
        Project::create($data);
    }

    public static function readAccessibleProject($userLoggedIn)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT DISTINCT p.projectId, p.name, p.owner FROM projectAccess pa 
                               RIGHT JOIN project p ON pa.projectId = p.projectId 
                               WHERE pa.allowAccess = 1 AND pa.userId = ? OR p.owner = ?");
        $stmt->execute([$userLoggedIn->userId, $userLoggedIn->userId]);
        return $stmt->fetchAll();
    }
    
    public static function readProject($projectId, $active)
    {
        $projects = Project::withProjectId($projectId);
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
