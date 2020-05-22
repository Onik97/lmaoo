<?php  
require('../connection.php');
require('user.php');
error_reporting(0);
$function = $_POST['function'];
$logout = $_POST['logout'];

if ($function == "login")
{
	login();
}
else if ($function == "register")
{
	$checker = hasDup();
	if ($checker == "1")
	{
		session_start();
    	$_SESSION['message'] = 'Username already exist! Try logging in!';
		header("Location: index.php");
	}
	else
	{
		register();
	}
}
else if ($function == 'update')
{
	updateUser();
}
else if (isset($logout))
{
	logout();
}
else if ($function == "checkUsername")
{
	if (hasDup())
	{
		$json->fromServer = "True";
		echo json_encode($json);
	}
	else if (!hasDup())
	{
		$json->fromServer = "False";
		echo json_encode($json);
	}
}
else if ($function == "getActiveUsers")
{
	getActiveUsers();
}
else 
{
	return;
}

function hasDup()
{
	$boolean = false;
	$username = $_POST['username'];
	$pdo = logindb('user', 'pass');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$stmt = $pdo->prepare("SELECT username FROM user WHERE username = ?");
	$stmt->execute([$username]);

	if($stmt->rowCount() > 0)
	{
		$boolean = true;
	}
	else
	{
		// Should stay False
	}
	return $boolean;
}

function updateUser()
{
	$editForename = $_POST['editForename'];
	$editSurname = $_POST['editSurname'];
	$editUsername = $_POST['editUsername'];
	$editUserId = $_POST['editUserId'];
	$pdo = logindb('user', 'pass');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$stmt = $pdo->prepare("UPDATE user SET forename=?, surname=?, username=? WHERE userId=?");
	$stmt->execute([$editForename, $editSurname, $editUsername, $editUserId]);
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
	$stmt = $pdo->prepare("SELECT userId, forename, surname, username, level FROM user WHERE userId = ?");
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
		if($user->isActive == true)
		{
			$userLoggedIn = new user($user->userId, $user->forename, $user->surname, $user->username, $user->password, $user->level, $user->isActive);
			session_start();
			$_SESSION['userLoggedIn'] = $userLoggedIn;
			header("Location: ../Project/index.php");
		}
		else
		{
			session_start();
			$_SESSION['message'] = 'User deactivated, contact the administrator';
			header("Location: index.php");
		}
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
	$password = $_POST['password1'];
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

function getAllUsers() // This is used in Admin
{
	$pdo = logindb('user', 'pass');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$stmt = $pdo->prepare("SELECT * FROM user");
	$stmt->execute();
	$users = $stmt->fetchAll();
	return $users;
}
function getActiveUsers()
{
	$isActive = '1';
	$pdo = logindb('user', 'pass');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$stmt = $pdo->prepare('SELECT * FROM user WHERE isActive = ?');
	$stmt->execute();
	$activeUsers = $stmt->fetchall();
	return $activeUsers;
}
?>