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


function createComment($commentContent, $ticketId, $userId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("INSERT INTO comment (commentId, commentContent, ticketId, userId) VALUES (null, ?, ?, ?)");
    $stmt->execute([$commentContent, $ticketId, $userId]);
    echo "Success"; // Using echo for XMLHttpRequest
}

function createBugs($userId, $projectId)
{

}

function deleteComment($commentId)
{

}

function deleteBugs($bugId)
{

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

function loadBugs($ticketId)
{

}


?>