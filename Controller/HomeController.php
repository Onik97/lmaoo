<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class HomeController
{
    public static function loadTicketsWithDeadline()
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT ticketId, summary, progress, deadline FROM ticket WHERE assignee_key = ? ORDER BY deadline DESC");
        $stmt->execute([unserialize($_SESSION['userLoggedIn'])->userId]);
        return $stmt->fetchAll();
    }

    public static function loadOwnProjects()
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT projectId, name, status FROM project WHERE owner = ?");
        $stmt->execute([unserialize($_SESSION['userLoggedIn'])->userId]);
        return $stmt->fetchAll();
    }
}