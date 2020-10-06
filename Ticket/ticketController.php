<?php
error_reporting(0);
$function = $_POST['function'];

if ($function == "checkTicket")
{
    ticketExistance($_GET['ticketId']);
}
else if ($function == "createComment")
{
    createComment($_POST['commentContent'], $_POST['ticketId'], $_POST['userId']);
}
else if ($function == "loadComments")
{
    echo json_encode(loadComments($_POST['ticketId']));
}
else if ($function == "updateComment")
{
    echo updateComment($_POST['commentId'], $_POST['commentContent']);
}
else if ($function == "deleteComment")
{
    echo deleteComment($_POST['commentId']);
}
else if ($function == "saveSelectedAssignee")
{
    echo saveSelectedAssignee($_POST['ticketId'], $_POST['assigneeId']);
}
else if ($function == "assigneeSelf")
{
    echo assigneeYourself($_POST['ticketId'], $_POST['selfId']);
}
else if ($function == "loadUsers")
{
    echo json_encode(loadUsers());
}
else if ($function == "loadDates")
{
    echo json_encode(loadDates($_POST['ticketId']));
}
else if ($function == "loadAssignee")
{
    echo json_encode(loadAssignee($_POST["ticketId"]));
}
else if ($function == "loadReporter")
{
    echo json_encode(loadReporter($_POST['ticketId']));
}
else if ($function == "updateTicketTime")
{
    updateTicketTime($_POST["ticketId"]);
}
else 
{
    return;
}

function updateTicketTime($ticketId)
{
    $pdo = logindb("user", "pass");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("UPDATE ticket SET updated = ? WHERE ticketId = ?");
    $stmt->execute([date("Y-m-d H:i:s", time() - 3600), $ticketId]);
}

function ticketExistance($ticketId)
{
    $pdo = logindb("user", "pass");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT ticketId FROM ticket WHERE ticketId = ?");
    $stmt->execute([$ticketId]);

    return $stmt->fetchColumn() == 0 ? false : true;
}

function loadUsers()
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT userId, forename, surname FROM user");
    $stmt->execute();
    return $stmt->fetchAll();
}

function createComment($commentContent, $ticketId, $userId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("INSERT INTO comment (commentId, commentContent, ticketId, userId) VALUES (null, ?, ?, ?)");
    $stmt->execute([$commentContent, $ticketId, $userId]);
}

function updateComment($commentId, $newComment)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("UPDATE comment SET commentContent = ? WHERE commentId = ?");
    $stmt->execute([$newComment, $commentId]);
}

function loadComments($ticketId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT comment.commentId, comment.commentContent, comment.commentCreated, user.userId, user.forename, user.surname 
                           FROM comment INNER JOIN user on user.userId = comment.userId
                           WHERE comment.ticketId = ?");
    $stmt->execute([$ticketId]);
    return $stmt->fetchAll();
}

function deleteComment($commentId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("DELETE FROM comment WHERE commentId = ?");
    $stmt->execute([$commentId]);
}

function saveSelectedAssignee($ticketId, $newAssignee)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("UPDATE ticket SET assignee_key = ? WHERE ticketId = ?");
    $stmt->execute([$newAssignee, $ticketId]);
}

function assigneeYourself($ticketId, $selfKey)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("UPDATE ticket SET assignee_key = ? WHERE ticketId = ?");
    $stmt->execute([$selfKey, $ticketId]);
}

function loadDates($ticketId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT created, updated FROM ticket WHERE ticketId = ?");
    $stmt->execute([$ticketId]);
    return $stmt->fetchAll();
}

function loadAssignee($ticketId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT user.forename, user.surname, user.username, user.userId FROM ticket 
                           INNER JOIN user on user.userId = ticket.assignee_key
                           WHERE ticket.ticketId = ?");
    $stmt->execute([$ticketId]);
    return $stmt->fetchAll();
}

function loadReporter($ticketId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT user.forename, user.surname, user.username, user.userId FROM ticket 
                           INNER JOIN user on user.userId = ticket.reporter_key
                           WHERE ticket.ticketId = ?");
    $stmt->execute([$ticketId]);
    return $stmt->fetchAll();
}

function loadSearchBar() 
{
    if (!isset($_SESSION["userLoggedIn"])) { return;} ?>

    <form class="navbar-brand form-inline lg-1">
        <input class="form-control mr-sm-2" type="search" placeholder="Search Ticket" aria-label="Search">
        <button class="btn btn-outline-success my-sm-0" type="submit">Search</button>
    </form>
    <?php
}
?>