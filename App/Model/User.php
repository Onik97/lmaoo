<?php
namespace Lmaoo\Model;

use Lmaoo\Core\Database;
use Lmaoo\Utility\Library;

class User extends Database implements IModel
{
    public static function create(array $data)
    {
        $sql = Library::arrayToInsertQuery("user", $data);
        (new Parent())->db()->query($sql)->parameters([])->exec();
    }

    public static function read(array $columns, array $conditions)
    {
        $sql = Library::arrayToSelectQuery("user", $columns, $conditions);
        return (new Parent())->db()->query($sql)->parameters([])->fetchAll();
    }

    public static function update($userId, array $data)
    {
        $sql = Library::arrayToUpdateQuery("user", "userId", $data);
        (new Parent())->db()->query($sql)->parameters([$userId])->exec();
    }

    public static function delete($userId)
    {
        $sql = Library::arrayToUpdateQuery("user", "userId", array("active" => 0));
        (new Parent())->db()->query($sql)->parameters([$userId])->exec();
    }
}
