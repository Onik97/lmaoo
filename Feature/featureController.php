<?php 
require_once("../connection.php"); 
// error_reporting(0);

if($_POST['function'] == "loadFeatures")
{
    echo json_encode(loadFeatures($_POST['projectId']));
}
else { return; }

function loadFeatures($projectId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("SELECT * FROM feature WHERE projectId = ?");
    $stmt->execute([$projectId]);
    return $stmt->fetchAll();
}
?>