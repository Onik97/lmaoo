<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../Core/Autoloader.php");

class Ticket extends Database implements IModel
{
    public static function create(array $data)
    {
        $sql = Library::arrayToInsertQuery("ticket", $data);
        self::db()::query($sql)::parameters([])::exec();
    }

    public static function withId($ticketId, $columns = null)
    {
        $sql = $columns != null 
        ? "SELECT $columns FROM ticket WHERE ticketId = ?" 
        : "SELECT t.ticketId, t.summary, t.created, t.updated, t.progress, t.reporter_key AS reporterId, t.assignee_key AS assigneeId, 
           CONCAT(u.forename, ' ' ,u.surname) AS reporter, u.username AS reporterUsername, 
           CONCAT(u2.forename, ' ' ,u2.surname) AS assignee, u2.username AS assigneeUsername FROM ticket t 
           INNER JOIN user u ON u.userId = t.reporter_key INNER JOIN user u2 ON u2.userId = t.assignee_key 
           WHERE t.ticketId = ?";
        return self::db()::query($sql)::parameters([$ticketId])::fetchObject();
    }

    public static function update($ticketId, array $data)
    {
        $sql = Library::arrayToUpdateQuery("ticket", $data);
        self::db()::query($sql)::parameters([$ticketId])::exec();
    }

    public static function delete($ticketId)
    {
        $sql = "UPDATE ticket SET active = 0 WHERE ticketId = ?";
        self::db()::query($sql)::parameters([$ticketId])::exec();
    }
}
