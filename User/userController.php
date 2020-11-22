<?php  
require_once(__DIR__ . "/../connection.php");
require_once(__DIR__ . "/user.php");
$userController = new userController();
error_reporting(0);

$function = $_POST['function'];
$logout = $_POST['logout'];

if ($function == "login")
{
	$userController->login();
}
else if ($function == "register")
{
	$checker = $userController->hasDup(null);
	if ($checker == "1")
	{
		session_start();
    	$_SESSION['message'] = 'Username already exist! Try logging in!';
		header("Location: index.php");
	}
	else
	{
		$userController->register();
	}
}
else if ($function == 'update')
{
	$userController->updateUser();
}
else if (isset($logout))
{
	$userController->logout();
}
else if ($function == "checkUsername")
{
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
	echo json_encode($userController->getActiveUsers());
}
else if ($function == "darkMode")
{
	$userController->darkMode();
}
else
{
	return;
}

class userController 
{
	public function hasDup(?string $unitTest)
	{
		$username = ($unitTest == null) ? $_POST['username'] : $unitTest;
		$pdo = logindb('user', 'pass');
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT username FROM user WHERE username = ?");
		$stmt->execute([$username]);

		return $stmt->rowCount() > 0 ? true : false;
	}

	public function updateUser()
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
		$userLoggedIn = $_SESSION["userLoggedIn"];
		$userLoggedIn->setForename($editForename);
		$userLoggedIn->setSurname($editSurname);
		$userLoggedIn->setUsername($editUsername);
		$_SESSION['message'] = 'Your User Details has been updated';
		header("Location: ../Home/index.php");
	}

	public function userInfoById($userId)
	{
		$pdo = logindb('user', 'pass');
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT userId, forename, surname, username, level FROM user WHERE userId = ?");
		$stmt->execute([$userId]);
		$user = $stmt->fetch();
		return $user;
	}

	public function login()
	{
		$loginUsername = $_POST['username'];
		$loginPassword = $_POST['password'];

		$pdo = logindb('user', 'pass');
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
		$stmt->execute([$loginUsername]);
		$user = $stmt->fetch();
		$userController = new userController();

		if (password_verify($loginPassword, $user->password))
		{
			if($user->isActive == true)
			{
				$userLoggedIn = new user($user->userId, $user->forename, $user->surname, $user->username, $user->password, $user->level, $user->isActive);
				session_start();
				$_SESSION['userLoggedIn'] = $userLoggedIn;
				header("Location: ../Home/index.php");
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
			$userController->failedLogin();
		}

	}

	public function register()
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

	public function logout()
	{
		session_start();
		session_unset();
		session_destroy();
		header("Location: index.php");
	}

	public function failedLogin() // May change to return false in the future to allow dynamic login page
	{
		session_start();
		$_SESSION['message'] = 'Login attempted failed';
		header("Location: index.php");
	}

	public function getAllUsers() // This is used in Admin -> May be moved, not unit testing
	{
		$pdo = logindb('user', 'pass');
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT * FROM user");
		$stmt->execute();
		$users = $stmt->fetchAll();
		return $users;
	}

	public function getActiveUsers() // Again this is used in Admin -> May be moved, not unit testing
	{
		$pdo = logindb('user', 'pass');
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT userId, forename, surname, username FROM user WHERE isActive = 1");
		$stmt->execute();
		$activeUsers = $stmt->fetchall();
		return $activeUsers;
	}

	public function darkMode()
	{
		$darkModeUpdate = $_POST['darkMode']
		$userId = $_POST['userId']

		$pdo = logindb('user', 'pass');
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("UPDATE user SET darkMode=? WHERE userId=?");
		$stmt->execute([$darkModeUpdate, $userId]);
	}
}
?>