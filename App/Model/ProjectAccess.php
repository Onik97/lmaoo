<?php
namespace Lmaoo\Model;

use Lmaoo\Core\Database;
use Lmaoo\Utility\Library;

class ProjectAccess extends Database
{
    public static function create(array $data) 
    {
        $sql = Library::arrayToInsertQuery("projectAccess", $data);
        self::db()::query($sql)::parameters([])::exec();
    }

    public static function Navbar(string $userId)
    {
        $sql = "SELECT DISTINCT p.projectId, p.name, p.owner FROM projectAccess pa RIGHT JOIN project p ON pa.projectId = p.projectId 
                WHERE pa.allowAccess = 1 AND pa.userId = ? OR p.owner = ?";
        return self::db()::query($sql)::parameters([$userId, $userId])::fetchAll();
    }

    public static function withManagerAccess(string $userId)
    {
        $sql = "SELECT pa.userId, pa.projectId, p.name, p.status FROM projectAccess pa INNER JOIN project p ON pa.projectId = p.projectId 
                WHERE pa.managerAccess = 1 AND pa.userId = ?";
        return self::db()::query($sql)::parameters([$userId])::fetchAll();
    }

    public static function delete($projectId)
    {
        $sql = "DELETE FROM projectAccess WHERE projectId = ?";
        return self::db()::query($sql)::parameters([$projectId])::exec();
    }
}