<?php require('userController.php'); 
error_reporting(0);	

$userId = $_GET['userId'];
$function = $_POST['function'];

if(isset($userId))
{
    $userSelected = userInfoById($userId);
    echo json_encode($userSelected);
}

if($function == "adminUpdate")
{
    echo "I got the edit :)";
}
?>