<?php
require('../connection.php');
$function = $_POST['function'];

if ($function == "createComment")
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
else
{
    
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
    $stmt = $pdo->prepare("SELECT comment.commentId, comment.commentContent, user.userId, user.forename, user.surname 
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

function createBugs($userId, $projectId)
{

}

function deleteBugs($bugId)
{

}

function loadBugs($ticketId)
{

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

function updatePeople($ticketId)
{

}

?>