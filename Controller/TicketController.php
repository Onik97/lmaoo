<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class TicketController
{
    public static function getTicket($ticketId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT t.ticketId, t.summary, t.created, t.updated, t.progress, 
                               t.reporter_key AS reporterId, t.assignee_key AS assigneeId, 
                               CONCAT(u.forename, ' ' ,u.surname) AS reporter, u.username AS reporterUsername, 
                               CONCAT(u2.forename, ' ' ,u2.surname) AS assignee, u2.username AS assigneeUsername FROM ticket t 
                               INNER JOIN user u ON u.userId = t.reporter_key INNER JOIN user u2 ON u2.userId = t.assignee_key 
                               WHERE t.ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchObject();
    }

    public static function updateTicketTime($ticketId)
    {
        date_default_timezone_set('Europe/London');
        $time = date("Y-m-d H:i:s"); 

        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET updated = ? WHERE ticketId = ?");
        $stmt->execute([$time, $ticketId]);
    }

    public static function ticketIdExistance($ticketId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT summary FROM ticket WHERE ticketId = ?");
        $stmt->execute([$ticketId]);

        return $stmt->fetchColumn() ? true : false;
    }

    public static function ticketExistance($ticketName, $featureId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT summary FROM ticket WHERE summary = ? AND featureId = ?");
        $stmt->execute([$ticketName, $featureId]);

        return $stmt->fetchColumn() ? true : false;
    }

    public static function createComment($commentContent, $ticketId, $userId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("INSERT INTO comment (commentId, commentContent, ticketId, userId) VALUES (null, ?, ?, ?)");
        $stmt->execute([$commentContent, $ticketId, $userId]);
    }

    public static function updateComment($commentId, $newComment)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE comment SET commentContent = ? WHERE commentId = ?");
        $stmt->execute([$newComment, $commentId]);
    }

    public static function loadComments($ticketId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT comment.ticketId, comment.commentId, comment.commentContent, comment.commentCreated, user.userId, user.forename, user.surname, user.picture
                            FROM comment INNER JOIN user on user.userId = comment.userId
                            WHERE comment.ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public static function deleteComment($commentId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("DELETE FROM comment WHERE commentId = ?");
        $stmt->execute([$commentId]);
    }

    public static function saveSelectedAssignee($ticketId, $newAssignee)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET assignee_key = ? WHERE ticketId = ?");
        $stmt->execute([$newAssignee, $ticketId]);
    }

    public static function assigneeYourself($ticketId, $selfKey)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET assignee_key = ? WHERE ticketId = ?");
        $stmt->execute([$selfKey, $ticketId]);
    }

    public static function loadDates($ticketId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT created, updated FROM ticket WHERE ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public static function loadAssignee($ticketId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT user.forename, user.surname, user.username, user.userId FROM ticket 
                            INNER JOIN user on user.userId = ticket.assignee_key
                            WHERE ticket.ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public static function loadReporter($ticketId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT user.forename, user.surname, user.username, user.userId FROM ticket 
                            INNER JOIN user on user.userId = ticket.reporter_key
                            WHERE ticket.ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public static function loadSummary($ticketId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT summary from ticket WHERE ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchColumn();
    }

    public static function loadProgress($ticketId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT progress from ticket WHERE ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchColumn();
    }

    public static function changeProgress($progress, $ticketId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET progress = ? WHERE ticketId = ?");
        $stmt->execute([$progress, $ticketId]);
    }

    public static function saveSummary($summary, $ticketId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET summary = ? WHERE ticketId = ?");
        $stmt->execute([$summary, $ticketId]);
    }

    public static function loadSearchBar($userLoggedIn) 
    {
        if ($userLoggedIn == null) return;
    
        echo "<div class='navbar-brand form-inline lg-1'>";
        echo "<input id='searchBarInput' class='form-control mr-sm-2' type='search' placeholder='Search Ticket' aria-label='Search'>";
        echo "<button id='searchBarBtn' class='btn btn-outline-success my-sm-0' onclick='searchBar()'>Search</button>";
        echo "</div>";
    }

    public static function loadTicket()
    {
        $ticketId = $_GET["ticketId"];
        if ($ticketId == null) return Library::redirectWithMessage("Ticket ID not valid", "../Home/index.php");

        $ticket = TicketController::getTicket($ticketId);
        return ($ticket == null) 
        ? Library::redirectWithMessage("TicketId not valid", "../Home/index.php")
        : $ticket;
    }
}
