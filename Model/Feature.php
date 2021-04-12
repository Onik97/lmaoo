<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../Core/Autoloader.php");

class Feature extends Database implements IModel
{
    public static function create(array $data)
    {
        $sql = Library::arrayToInsertQuery("feature", $data);
        self::db()::query($sql)::parameters([])::exec();
    }

    public static function withId($featureId, $columns = null)
    {
        $sql = $columns == null ? "SELECT * FROM feature WHERE featureId = ?" : "SELECT $columns FROM feature WHERE featureId = ?";
        return self::db()::query($sql)::parameters([$featureId])::fetchObject();
    }

    public static function withProjectId($projectId, $columns = null)
    {
        $sql = $columns == null ? "SELECT * FROM feature WHERE projectId = ?" : "SELECT $columns FROM feature WHERE projectId = ?";
        return self::db()::query($sql)::parameters([$projectId])::fetchAll();
    }

    public static function update($featureId, array $data)
    {
        $sql = Library::arrayToUpdateQuery("feature", $data);
        self::db()::query($sql)::parameters([$featureId])::exec();
    }

    public static function delete($featureId)
    {
        $sql = "UPDATE feature SET active = 0 WHERE featureId = ?";
        self::db()::query($sql)::parameters([$featureId])::exec();
    }
}