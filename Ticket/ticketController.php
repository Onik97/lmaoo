<?php
require_once(__DIR__ . "/../connection.php");
error_reporting(0);

$usercontroller = new ticketController();
$function = $_POST['function'];

if ($function == "checkTicket")
{
    echo $ticketController->ticketIdExistance($_POST['ticketId']);
}
else if ($function == "checkTicketExistance")
{
    echo $ticketController->ticketExistance($_POST['ticketName'], $_POST['featureId']);
}
else if ($function == "createComment")
{
    $ticketController->createComment($_POST['commentContent'], $_POST['ticketId'], $_POST['userId']);
}
else if ($function == "loadComments")
{
    echo json_encode($ticketController->loadComments($_POST['ticketId']));
}
else if ($function == "updateComment")
{
    echo $ticketController->updateComment($_POST['commentId'], $_POST['commentContent']);
}
else if ($function == "deleteComment")
{
    echo $ticketController->deleteComment($_POST['commentId']);
}
else if ($function == "saveSelectedAssignee")
{
    echo $ticketController->saveSelectedAssignee($_POST['ticketId'], $_POST['assigneeId']);
}
else if ($function == "assigneeSelf")
{
    echo $ticketController->assigneeYourself($_POST['ticketId'], $_POST['selfId']);
}
else if ($function == "loadUsers")
{
    echo json_encode($ticketController->loadUsers());
}
else if ($function == "loadDates")
{
    echo json_encode($ticketController->loadDates($_POST['ticketId']));
}
else if ($function == "loadAssignee")
{
    echo json_encode($ticketController->loadAssignee($_POST["ticketId"]));
}
else if ($function == "loadReporter")
{
    echo json_encode($ticketController->loadReporter($_POST['ticketId']));
}
else if ($function == "updateTicketTime")
{
    $ticketController->updateTicketTime($_POST["ticketId"]);
}
else 
{
    ob_clean();
    header('HTTP/1.0 404 Not Found');
}

class ticketController
{
    public function updateTicketTime($ticketId)
    {
        $pdo = logindb("user", "pass");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET updated = ? WHERE ticketId = ?");
        $stmt->execute([date("Y-m-d H:i:s", time() - 3600), $ticketId]);
    }

    public function ticketIdExistance($ticketId)
    {
        $pdo = logindb("user", "pass");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT summary FROM ticket WHERE ticketId = ?");
        $stmt->execute([$ticketId]);

        return $stmt->fetchColumn() ? true : false;
    }

    public function ticketExistance($ticketName, $featureId)
    {
        $pdo = logindb("user", "pass");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT summary FROM ticket WHERE summary = ? AND featureId = ?");
        $stmt->execute([$ticketName, $featureId]);

        return $stmt->fetchColumn() ? true : false;
    }

    public function createComment($commentContent, $ticketId, $userId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("INSERT INTO comment (commentId, commentContent, ticketId, userId) VALUES (null, ?, ?, ?)");
        $stmt->execute([$commentContent, $ticketId, $userId]);
    }

    public function updateComment($commentId, $newComment)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE comment SET commentContent = ? WHERE commentId = ?");
        $stmt->execute([$newComment, $commentId]);
    }

    public function loadComments($ticketId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT comment.ticketId, comment.commentId, comment.commentContent, comment.commentCreated, user.userId, user.forename, user.surname 
                            FROM comment INNER JOIN user on user.userId = comment.userId
                            WHERE comment.ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public function deleteComment($commentId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("DELETE FROM comment WHERE commentId = ?");
        $stmt->execute([$commentId]);
    }

    public function saveSelectedAssignee($ticketId, $newAssignee)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET assignee_key = ? WHERE ticketId = ?");
        $stmt->execute([$newAssignee, $ticketId]);
    }

    public function assigneeYourself($ticketId, $selfKey)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET assignee_key = ? WHERE ticketId = ?");
        $stmt->execute([$selfKey, $ticketId]);
    }

    public function loadDates($ticketId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT created, updated FROM ticket WHERE ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public function loadAssignee($ticketId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT user.forename, user.surname, user.username, user.userId FROM ticket 
                            INNER JOIN user on user.userId = ticket.assignee_key
                            WHERE ticket.ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public function loadReporter($ticketId)
    {
        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT user.forename, user.surname, user.username, user.userId FROM ticket 
                            INNER JOIN user on user.userId = ticket.reporter_key
                            WHERE ticket.ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public function loadSearchBar() 
    {
        if (!isset($_SESSION["userLoggedIn"])) { return; } ?>
    
        <div class="navbar-brand form-inline lg-1">
            <input id="searchBarInput" class="form-control mr-sm-2" type="search" placeholder="Search Ticket" aria-label="Search" onkeyup="searchBar()">
            <button id="searchBarBtn" class="btn btn-outline-success my-sm-0">Search</button>
        </div>
        <?php
    }
}
?>

