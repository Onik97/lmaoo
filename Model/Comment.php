<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class Ticket extends Database
{
    public static function createComment($comment, $ticketId, $userId)
    {
        $sql = "INSERT INTO comment (commentId, commentContent, ticketId, userId) VALUES (null, ?, ?, ?)";
        return self::db()::query($sql)::parameters([$comment, $ticketId, $userId])::exec();
    }

    public static function withTicketId($ticketId)
    {
        $sql = "SELECT comment.ticketId, comment.commentId, comment.commentContent, comment.commentCreated, user.userId, user.forename, user.surname, user.picture
                FROM comment INNER JOIN user ON user.userId = comment.userId WHERE comment.ticketId = ?";
        return self::db()::query($sql)::parameters([$ticketId])::fetchAll();
    }

    public static function updateComment($comment, $commentId)
    {
        $sql = "UPDATE comment SET commentContent = ? WHERE commentId = ?";
        return self::db()::query($sql)::parameters([$comment, $commentId])::fetchAll();
    }

    public static function deleteComment($commentId)
    {
        $sql = "DELETE FROM comment WHERE commentId = ?";
        self::db()::query($sql)::parameters([$commentId])::exec();
    }
}
