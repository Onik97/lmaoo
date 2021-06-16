<?php
namespace Lmaoo\Model;

use Lmaoo\Core\Database;
use Lmaoo\Utility\Library;

class Comment extends Database implements IModel
{
    public static function create(array $data)
    {
        $sql = Library::arrayToInsertQuery("comment", $data);
        (new Database())->db()->query($sql)->parameters([])->exec();
    }

    public static function withId($commentId, $columns = null)
    {
        $sql = $columns == null ? "SELECT * FROM comment WHERE commentId = ?" : "SELECT $columns FROM comment WHERE commentId = ?";
        return (new Database())->db()->query($sql)->parameters([$commentId])->fetchObject();
    }

    public static function withTicketId($ticketId)
    {
        $sql = "SELECT comment.ticketId, comment.commentId, comment.commentContent, comment.commentCreated, user.userId, user.forename, user.surname, user.picture
                FROM comment INNER JOIN user ON user.userId = comment.userId WHERE comment.ticketId = ?";
        return (new Database())->db()->query($sql)->parameters([$ticketId])->fetchAll();
    }

    public static function update($commentId, array $data)
    {
        $sql = Library::arrayToUpdateQuery("comment", "commentId", $data);
        (new Database())->db()->query($sql)->parameters([$commentId])->exec();
    }

    public static function delete($commentId)
    {
        $sql = "DELETE FROM comment WHERE commentId = ?";
        (new Database())->db()->query($sql)->parameters([$commentId])->exec();
    }
}
