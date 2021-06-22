<?php
namespace Lmaoo\Model;

use Lmaoo\Core\Database;
use Lmaoo\Utility\Library;

class Project extends Database implements IModel
{
    public static function create(array $data)
    {
        $sql = Library::arrayToInsertQuery("project", $data);
        (new Database())->db()->query($sql)->parameters([])->exec();
    }

    public static function read(array $columns, array $conditions)
    {
        $sql = Library::arrayToSelectQuery("project", $columns, $conditions);
        return (new Parent())->db()->query($sql)->parameters([])->fetchAll();
    }

    public static function withId($projectId, $columns = null)
    {
        $sql = $columns == null ? "SELECT * FROM project WHERE projectId = ?" : "SELECT $columns FROM project WHERE projectId = ?";
        return (new Database())->db()->query($sql)->parameters([$projectId])->fetchObject();
    }

    public static function withOwnerId($ownerId, $columns = null)
    {
        $sql = $columns == null ? "SELECT * FROM project WHERE owner = ?" : "SELECT $columns FROM project WHERE owner = ?";
        return (new Database())->db()->query($sql)->parameters([$ownerId])->fetchAll();
    }

    public static function update($projectId, array $data)
    {
        $sql = Library::arrayToUpdateQuery("project", "projectId", $data);
        (new Database())->db()->query($sql)->parameters([$projectId])->exec();
    }

    public static function delete($projectId)
    {
        $sql = "UPDATE project SET active = 0 WHERE projectId = ?";
        (new Database())->db()->query($sql)->parameters([$projectId])->exec();
    }
}