<?php require_once(__DIR__ . "/../connection.php");
$ticketController = new ticketController();

if ($function == "checkTicket")
{
    validateDeveloper();
    echo $ticketController->ticketIdExistance($_POST['ticketId']);
}
else if ($function == "checkTicketExistance")
{
    validateDeveloper();
    echo $ticketController->ticketExistance($_POST['ticketName'], $_POST['featureId']);
}
else if ($function == "createComment")
{
    validateDeveloper();
    $ticketController->createComment($_POST['commentContent'], $_POST['ticketId'], $_POST['userId']);
}
else if ($function == "loadComments")
{
    validateDeveloper();
    echo json_encode($ticketController->loadComments($_POST['ticketId']));
}
else if ($function == "updateComment")
{
    validateDeveloper();
    echo $ticketController->updateComment($_POST['commentId'], $_POST['commentContent']);
}
else if ($function == "deleteComment")
{
    validateDeveloper();
    echo $ticketController->deleteComment($_POST['commentId']);
}
else if ($function == "saveSelectedAssignee")
{
    validateDeveloper();
    echo $ticketController->saveSelectedAssignee($_POST['ticketId'], $_POST['assigneeId']);
}
else if ($function == "assigneeSelf")
{
    validateDeveloper();
    echo $ticketController->assigneeYourself($_POST['ticketId'], $_POST['selfId']);
}
else if ($function == "loadDates")
{
    validateDeveloper();
    echo json_encode($ticketController->loadDates($_POST['ticketId']));
}
else if ($function == "loadAssignee")
{
    validateDeveloper();
    echo json_encode($ticketController->loadAssignee($_POST["ticketId"]));
}
else if ($function == "loadReporter")
{
    validateDeveloper();
    echo json_encode($ticketController->loadReporter($_POST['ticketId']));
}
else if ($function == "updateTicketTime")
{
    validateDeveloper();
    $ticketController->updateTicketTime($_POST["ticketId"]);
}
else 
{
    ob_clean();
    return;
}

class ticketController
{
    public function updateTicketTime($ticketId)
    {
        date_default_timezone_set('Europe/London');
        $time = date("Y-m-d H:i:s"); 

        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET updated = ? WHERE ticketId = ?");
        $stmt->execute([$time, $ticketId]);
    }

    public function ticketIdExistance($ticketId)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT summary FROM ticket WHERE ticketId = ?");
        $stmt->execute([$ticketId]);

        return $stmt->fetchColumn() ? true : false;
    }

    public function ticketExistance($ticketName, $featureId)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT summary FROM ticket WHERE summary = ? AND featureId = ?");
        $stmt->execute([$ticketName, $featureId]);

        return $stmt->fetchColumn() ? true : false;
    }

    public function createComment($commentContent, $ticketId, $userId)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("INSERT INTO comment (commentId, commentContent, ticketId, userId) VALUES (null, ?, ?, ?)");
        $stmt->execute([$commentContent, $ticketId, $userId]);
    }

    public function updateComment($commentId, $newComment)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE comment SET commentContent = ? WHERE commentId = ?");
        $stmt->execute([$newComment, $commentId]);
    }

    public function loadComments($ticketId)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT comment.ticketId, comment.commentId, comment.commentContent, comment.commentCreated, user.userId, user.forename, user.surname, user.picture
                            FROM comment INNER JOIN user on user.userId = comment.userId
                            WHERE comment.ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public function deleteComment($commentId)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("DELETE FROM comment WHERE commentId = ?");
        $stmt->execute([$commentId]);
    }

    public function saveSelectedAssignee($ticketId, $newAssignee)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET assignee_key = ? WHERE ticketId = ?");
        $stmt->execute([$newAssignee, $ticketId]);
    }

    public function assigneeYourself($ticketId, $selfKey)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE ticket SET assignee_key = ? WHERE ticketId = ?");
        $stmt->execute([$selfKey, $ticketId]);
    }

    public function loadDates($ticketId)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT created, updated FROM ticket WHERE ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public function loadAssignee($ticketId)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT user.forename, user.surname, user.username, user.userId FROM ticket 
                            INNER JOIN user on user.userId = ticket.assignee_key
                            WHERE ticket.ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public function loadReporter($ticketId)
    {
        $pdo = logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT user.forename, user.surname, user.username, user.userId FROM ticket 
                            INNER JOIN user on user.userId = ticket.reporter_key
                            WHERE ticket.ticketId = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public function loadSearchBar($userLoggedIn) 
    {
        if ($userLoggedIn == null) return;
    
        echo "<div class='navbar-brand form-inline lg-1'>";
        echo "<input id='searchBarInput' class='form-control mr-sm-2' type='search' placeholder='Search Ticket' aria-label='Search'>";
        echo "<button id='searchBarBtn' class='btn btn-outline-success my-sm-0' onclick='searchBar()'>Search</button>";
        echo "</div>";
    }
}
?>