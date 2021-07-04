<?php
namespace Lmaoo\Model;

use Lmaoo\Core\Database;
use Lmaoo\Utility\Library;

class Feature extends Database implements IModel
{
    public static function create(array $data)
    {
        $sql = Library::arrayToInsertQuery("feature", $data);
        return (new Database())->db()->query($sql)->parameters([])->getLast();
    }

    public static function read(array $columns, array $conditions)
    {
        $sql = Library::arrayToSelectQuery("feature", $columns, $conditions);
        return (new Parent())->db()->query($sql)->parameters([])->fetchAll();
    }

    public static function update($featureId, array $data)
    {
        $sql = Library::arrayToUpdateQuery("feature", "featureId", $data);
        (new Database())->db()->query($sql)->parameters([$featureId])->exec();
    }

    public static function delete($featureId)
    {
        $sql = "UPDATE feature SET active = 0 WHERE featureId = ?";
        (new Database())->db()->query($sql)->parameters([$featureId])->exec();
    }
}