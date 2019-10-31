 <?php  
require('../connection.php');
require('user.php');
//error_reporting(0); // Removes undefined errors - Remove this if you are having problems
$function = $_POST['function'];
$forename = $_POST['forename'];
$surname = $_POST['surname'];
$username = $_POST['username'];
$password = $_POST['password'];
$logout = $_POST['logout'];

if ($function == "login")
{
	login();
}
else if ($function == "register")
{
	register();
}
else if ($function == "edit")
{
	editUser();
}
else if (isset($logout))
{
	logout();
}
else
{

}

function hasDuplications()
{
	$indicator;
	$username = $_POST['username'];

	$pdo = logindb('user', 'pass');
	$stmt = $pdo->prepare("SELECT username FROM user WHERE username = ?");
	$stmt->execute([$username]);

	if ($stmt->rowCount() > 0)
	{
		$indicator = true;
	}
	else
	{
		$indicator = false;
	}
	return $indicator;
}

function editUser()
{
	$editId = $_POST['editID'];
	$editForename = $_POST['forename'];
	$editSurname = $_POST['surname'];
	$editUsername = $_POST['username'];
	$pdo = logindb('user', 'pass');
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$stmt = $pdo->prepare("UPDATE user SET forename=?, surname=?, username=? WHERE userId=?");
	$stmt->execute([$editForename, $editSurname, $editUsername, $editId]);
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
		failedMessage("Login has failed", "index.php");
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

function failedMessage($message, $location)
{
    session_start();
    $_SESSION['message'] = $message;
	header("Location: " . $location);
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