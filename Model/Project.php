<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../Core/Autoloader.php");

class Project extends Database implements IModel
{
    public static function create(array $data)
    {
        $sql = Library::arrayToInsertQuery("project", $data);
        self::db()::query($sql)::parameters([])::exec();
    }

    public static function withId($projectId, $columns = null)
    {
        
        $sql = $columns == null ? "SELECT * FROM project WHERE projectId = ?" : "SELECT $columns FROM project WHERE projectId = ?";
        return self::db()::query($sql)::parameters([$projectId])::fetchObject();
    }

    public static function update($projectId)
    {
        $data = array("active" => "1");

        $sql = Library::arrayToUpdateQuery("project", $data);
        self::db()::query($sql)::parameters([$projectId])::exec();
    }

    public static function delete($projectId)
    {
        $data = array("active" => "0");

        $sql = "UPDATE project SET active = 0 WHERE projectId = ?";
        self::db()::query($sql)::parameters([$projectId])::exec();
    }
}