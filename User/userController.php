<?php  
require('../connection.php');
require('user.php');
//error_reporting(0);
$forename = $_POST['forename'];
$surname = $_POST['surname'];
$username = $_POST['username'];
$password = $_POST['password'];
$function = $_POST['function'];
$logout = $_POST['logout'];

if ($function == "login")
{
	login();
}
else if ($function == "register")
{
	register();
}
else if ($function == 'update')
{
	updateUser();
}
else if (isset($logout))
{
	logout();
}
else
{
	
}

function updateUser()
{
	$editForename = $_POST['forename'];
	$editSurname = $_POST['surname'];
	$editUsername = $_POST['username'];
	$pdo = logindb('user', 'pass');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$stmt = $pdo->prepare("UPDATE user SET forename=?, surname=? WHERE username=?");
	$stmt->execute([$editForename, $editSurname, $editUsername]);
	session_start();
	session_unset();
	session_destroy();
	session_start();
	$_SESSION['message'] = 'Your changes has been saved! Please login!';
	header("Location: index.php");
}

function userInfoById($userId)
{
	$pdo = logindb('user', 'pass');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$stmt = $pdo->prepare("SELECT * FROM user WHERE userId = ?");
	$stmt->execute([$userId]);
	$user = $stmt->fetch();
	return $user;
}

function login()
{
	$loginUsername = $_POST['username'];
	$loginPassword = $_POST['password'];

	$pdo = logindb('user', 'pass');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
	$stmt->execute([$loginUsername]);
	$user = $stmt->fetch();

	if (password_verify($loginPassword, $user->password))
	{
		$userLoggedIn = new user($user->userId, $user->forename, $user->surname, $user->username, $user->password, $user->level);
		session_start();
		$_SESSION['userLoggedIn'] = $userLoggedIn;
		header("Location: ../Ticket/index.php");
	}
	else
	{
		failedLogin();
	}

}

function register()
{
	$forename = $_POST['forename'];
	$surname = $_POST['surname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

	$pdo = logindb('user', 'pass');
	$stmt = $pdo->prepare("INSERT INTO user (userId, username, password, forename, surname) VALUES (null, ?, ?, ?, ?)");
	$stmt->execute([$username, $hashedPassword, $forename, $surname]);
	session_start();
    $_SESSION['message'] = 'Register Successful';
	header("Location: index.php");
}

function logout()
{
	session_start();
	session_unset();
	session_destroy();
	header("Location: index.php");
}

function failedLogin()
{
    session_start();
    $_SESSION['message'] = 'Login attempted failed';
	header("Location: index.php");
}

function getAllUsers()
{
	$pdo = logindb('user', 'pass');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$stmt = $pdo->prepare("SELECT * FROM user");
	$stmt->execute();
	$users = $stmt->fetchAll();
	return $users;
}
?>