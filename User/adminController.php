<?php require('userController.php'); 
//error_reporting(0);	

if (isset($_GET['edit']))
{
	echo 'This is the ID ' . $_GET['edit'];
	$userr = userInfoById($_GET['edit']);
	echo $userr->forename;
}
?>
