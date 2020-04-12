<?php require('userController.php'); 

$userId = $_GET['userId'];
$function = $_POST['function'];

if(isset($userId))
{
    $userSelected = userInfoById($userId);
    echo json_encode($userSelected);
}

if($function == "adminUpdate")
{
    adminUpdate($_POST['editForename'], $_POST['editSurname'], $_POST['editUsername'], $_POST['userSelect'], $_POST['userId']);
}

function adminUpdate($forename, $surname, $username, $level, $userId)
{
    $pdo = logindb('user', 'pass');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $stmt = $pdo->prepare("UPDATE user SET forename = ?, surname = ?, username = ?, level = ? WHERE userId = ?");
    $stmt->execute([$forename, $surname, $username, $level, $userId]);
    header("Location: admin.php");
}
?>