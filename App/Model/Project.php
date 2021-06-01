<?php
namespace Lmaoo\Model;

use Lmaoo\Core\Database;
use Lmaoo\Utility\Library;

class Project extends Database implements IModel
{
    public static function create(array $data)
    {
        $sql = Library::arrayToInsertQuery("project", $data);
        self::db()::query($sql)::parameters([])::exec();
    }

    public static function withId($data, $columns = null)
    {
        $sql = $columns == null ? "SELECT * FROM project WHERE projectId = ?" : "SELECT $columns FROM project WHERE projectId = ?";
        return self::db()::query($sql)::parameters([$projectId])::fetchObject();
    }

    public static function withProjectId($projectId, $columns = null)
    {
        $sql = $columns == null ? "SELECT * FROM project WHERE projectId = ?" : "SELECT $columns FROM project WHERE projectId = ?";
        return self::db()::query($sql)::parameters([$projectId])::fetchAll();
    }

    public static function update($projectId, array $data)
    {
        $sql = Library::arrayToUpdateQuery("project", $data);
        self::db()::query($sql)::parameters([$projectId])::exec();
    }

    public static function delete($projectId)
    {
        $sql = "UPDATE project SET active = 0 WHERE projectId = ?";
        self::db()::query($sql)::parameters([$projectId])::exec();
    }
}