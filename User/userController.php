<?php  
require('../connection.php');
require('user.php');
error_reporting(0); // Removes undefined errors - Remove this if you are having problems
$forename = $_POST['forename'];
$surname = $_POST['surname'];
$username = $_POST['username'];
$password = $_POST['password'];
$loginUsername = $_POST['loginUsername'];
$loginPassword = $_POST['loginPassword'];
$logout = $_POST['logout'];

if (isset($loginUsername, $loginPassword))
{
	login();
}
else if (isset($forename, $surname, $username, $password))
{
	register();
}
else if (isset($logout))
{
	logout();
}
else
{
	
}


function login()
{
	$loginUsername = $_POST['loginUsername'];
	$loginPassword = $_POST['loginPassword'];

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


function getUserById($userId)
{
	$pdo = logindb('user', 'pass');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$stmt = $pdo->prepare("SELECT * FROM user where userId = ?");
	$stmt->execute([$userId]);
	$users = $stmt->fetch();
	return $user;
}

?>