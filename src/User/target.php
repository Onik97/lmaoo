<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/lmaoo/includes/autoloader.inc.php");

$userController = new UserController();

$function = $_POST['function'];

if ($function == "login")
{
	$userController->login($_POST['username'], $_POST['password']);
}
else if ($function == "register")
{
	if ($userController->hasDup(null))
	{
    	$_SESSION['message'] = 'Username already exist! Try logging in!';
		header("Location: index.php");
	}
	else
	{
		$userController->register($_POST['forename'], $_POST['surname'], $_POST['username'], $_POST['password']);
	}
}
else if ($function == 'update')
{
	Validator::validateSuperUser();
	$userController->updateUser($_POST['editForename'], $_POST['editSurname'], $_POST['editUsername'], $_POST['editUserId']);
}
else if ($function == "checkUsername")
{
	Validator::validateManager();
	if ($userController->hasDup(null))
	{
		$json->fromServer = "True";
		echo json_encode($json);
	}
	else if (!$userController->hasDup(null))
	{
		$json->fromServer = "False";
		echo json_encode($json);
	}
}
else if ($function == "getActiveUsers") 
{
	Validator::validateDeveloper();
	echo json_encode($userController->getActiveUsers());
}
else if ($function == "darkModeToggle")
{
	Validator::validateDeveloper();
	$userController->darkModeToggle($_POST['darkMode'], $_POST['userId']);
}
else if ($function == "uploadProfilePic")
{
	Validator::validateDeveloper();
	echo $userController->uploadImage($_POST['userId'], null);
}
else 
{
    Library::notFoundMessage();
}