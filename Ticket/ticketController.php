<?php
require('../connection.php');
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
    echo updateComment($_POST['commentId'], $_POST['newComment']);
}
else if ($function == "deleteComment")
{
    echo deleteComment($_POST['commentId']);
}
else if ($function == "loadPeople")
{
    echo json_encode(loadPeople($_POST['ticketId']));
}
else if ($function == "savePeople")
{
    echo savePeople($_POST['ticketId'], $_POST['newAssignee']);
}
else if ($function == "peopleYourself")
{
    peopleYourself($_POST['fullName'], $_POST['ticketId']);
}
else if ($function == "loadUsers")
{
    echo json_encode(loadUsers());
}
else if ($function == "assigneeKeyUpdate")
{
    echo assigneeKey($_POST['key'], $_POST['ticketId']);
}
else if ($function == "loadDates")
{
    echo json_encode(loadDates($_POST['ticketId']));
}
else 
{
    return;
}

function ticketExistance($ticketId)
{
    $pdo = logindb("user", "pass");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT ticketId FROM ticket WHERE ticketId = ?");
    $stmt->execute([$ticketId]);
    
    if ($stmt->fetchColumn() == 0)
    {
        return false;
    }
    else
    {
        return true;
    }
}

function loadUsers()
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT userId, forename, surname FROM user");
    $stmt->execute();
    $users = $stmt->fetchAll();
    return $users;
}

function createComment($commentContent, $ticketId, $userId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("INSERT INTO comment (commentId, commentContent, ticketId, userId) VALUES (null, ?, ?, ?)");
    $stmt->execute([$commentContent, $ticketId, $userId]);
    echo "Success"; // Using echo for XMLHttpRequest
}

function updateComment($commentId, $newComment)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("UPDATE comment SET commentContent = ? WHERE commentId = ?");
    $stmt->execute([$newComment, $commentId]);
    echo "Success"; // Using echo for XMLHttpRequest
}

function loadComments($ticketId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT comment.commentId, comment.commentContent, comment.commentCreated, user.userId, user.forename, user.surname 
                           FROM comment INNER JOIN user on user.userId = comment.userId
                           WHERE comment.ticketId = ?");
    $stmt->execute([$ticketId]);
    $comments = $stmt->fetchAll();
    return $comments;
}

function deleteComment($commentId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("DELETE FROM comment WHERE commentId = ?");
    $stmt->execute([$commentId]);
    echo "Success"; // Using echo for XMLHttpRequest
}

function loadPeople($ticketId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT reporter, assignee FROM ticket WHERE ticketId = ?");
    $stmt->execute([$ticketId]);
    $people = $stmt->fetchAll();
    return $people;
}

function peopleYourself($fullName, $ticketId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("UPDATE ticket SET assignee = ? WHERE ticketId = ?");
    $stmt->execute([$fullName, $ticketId]);
    echo "Success"; // Using echo for XMLHttpRequest
}

function savePeople($ticketId, $newAssignee)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("UPDATE ticket SET assignee = ? WHERE ticketId = ?");
    $stmt->execute([$newAssignee, $ticketId]);
    echo "Success"; // Using echo for XMLHttpRequest
}

function assigneeKey($ticketId, $key)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("UPDATE ticket SET assignee_key = ? WHERE ticketId = ?");
    $stmt->execute([$key, $ticketId]);
    echo "Success"; // Using echo for XMLHttpRequest
}

function loadDates($ticketId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT created, updated FROM ticket WHERE ticketId = ?");
    $stmt->execute([$ticketId]);
    $dates = $stmt->fetchAll();
    return $dates;
}

?>