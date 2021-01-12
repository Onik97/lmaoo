<?php require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); 

class UserController 
{
	public function hasDup(?string $unitTest)
	{
		$username = $unitTest == null ? $_POST['username'] : $unitTest;
		$pdo = Connection::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT username FROM user WHERE username = ?");
		$stmt->execute([$username]);

		return $stmt->rowCount() > 0 ? true : false;
	}

	public function updateUser($forename, $surname, $username, $userId)
	{
		$pdo = Connection::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("UPDATE user SET forename = ?, surname = ?, username = ? WHERE userId = ?");
		$stmt->execute([$forename, $surname, $username, $userId]);

		$userLoggedIn = $_SESSION["userLoggedIn"];
		$userLoggedIn->setForename($forename);
		$userLoggedIn->setSurname($surname);
		$userLoggedIn->setUsername($username);
		$_SESSION['message'] = 'Your User Details has been updated';
		header("Location: ../Home/index.php");
	}

	public function userInfoById($userId) // Should be used for Unit Testing and Admin Only!
	{
		$pdo = Connection::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT * FROM user WHERE userId = ?");
		$stmt->execute([$userId]);
		$user = $stmt->fetch();
		return $user;
	}

	public function login($username, $password)
	{
		$pdo = Connection::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
		$stmt->execute([$username]);
		$user = $stmt->fetch();
		$userController = new userController();
		
		if (password_verify($password, $user->password))
		{
			if($user->isActive == true)
			{
				$userLoggedIn = new user($user->userId, $user->forename, $user->surname, $user->username, $user->password, $user->level, $user->isActive, $user->darkMode, $user->github_id);
				if ($user->darkMode != $_COOKIE["lmaooDarkMode"]) setcookie("lmaooDarkMode", $user->darkMode, 0, "/");
				
				// if ($user->github_id != null)
				// {
				// 	$githubController = new githubController();
				// 	$accessToken = $githubController->getAccessTokenFromDatabase($user->userId);
				// 	$githubUser = $githubController->getGithubUser($accessToken);
				// 	$userLoggedIn->createGithubProfile($githubUser['avatar_url'], $githubUser['name'], $githubUser['login']);
				// }

			
				$_SESSION['userLoggedIn'] = serialize($userLoggedIn);
				header("Location: ../Home/index.php");
			}
			else
			{
				$_SESSION['message'] = 'User deactivated, contact the administrator';
				header("Location: index.php");
			}
		}
		else
		{
			$userController->failedLogin();
		}

	}

	public function register($forename, $surname, $username, $password)
	{		
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

		$pdo = Connection::logindb();
		$stmt = $pdo->prepare("INSERT INTO user (userId, username, password, forename, surname) VALUES (null, ?, ?, ?, ?)");
		$stmt->execute([$username, $hashedPassword, $forename, $surname]);
		$_SESSION['message'] = 'Register Successful';
		header("Location: index.php");
	}

	public function failedLogin() // May change to return false in the future to allow dynamic login page
	{
		$_SESSION['message'] = 'Login attempted failed';
		header("Location: index.php");
	}

	public function getAllUsers() // This is used in Admin -> May be moved, not unit testing
	{
		$pdo = Connection::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT * FROM user");
		$stmt->execute();
		$users = $stmt->fetchAll();
		return $users;
	}

	public function getActiveUsers()
	{
		$pdo = Connection::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT userId, forename, surname, username, picture FROM user WHERE isActive = 1");
		$stmt->execute();
		$activeUsers = $stmt->fetchall();
		return $activeUsers;
	}

	public function darkModeToggle($toggle, $userId)
	{
		$pdo = Connection::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("UPDATE user SET darkMode = ? WHERE userId = ?");
		$stmt->execute([$toggle, $userId]);
	}

	public static function loadDarkMode($userId) // Keeping for Unit Testing
	{
		$pdo = Connection::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT darkMode FROM user WHERE userId = ?");
		$stmt->execute([$userId]);
		return $stmt->fetchColumn();
	}

	public function updatePicture($target, $userId)
	{
		$pdo = Connection::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("UPDATE user SET picture = ? WHERE userId = ?");
		$stmt->execute([$target, $userId]);
	}

	public function uploadImage($userId, ?string $unitTest)
	{
		$userController = new userController();
		$target_dir = $unitTest == null ? "../Images/profilePictures/" : __DIR__ . "../Images/profilePictures/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$ext = pathinfo($target_file, PATHINFO_EXTENSION);
		$rename = $target_dir . $userId . "." . $ext;
		
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
		{
			rename($target_file, $rename);
			$userController->updatePicture($rename, $userId);
			echo true;
		}
		else echo false;
	}

	public static function loadDarkModeToggle($toggle, $userLoggedIn)
	{ 
		$userLoggedIn = unserialize($userLoggedIn);
		if ($toggle == null) 
		{
			if ($userLoggedIn == null) 
			{
				$toggle = false;
				setcookie("lmaooDarkMode", false, 0, "/");
			}
			else if ($userLoggedIn != null)
			{
				$toggle = $userLoggedIn->getDarkMode();
				setcookie("lmaooDarkMode", $userLoggedIn->getDarkMode(), 0, "/");
			}
		}

		echo "<div class='custom-control custom-switch'>";
		echo $toggle == true ? "<input type='checkbox' class='custom-control-input' id='darkModeSwitch' onclick='darkModeToggle()' checked>" : "<input type='checkbox' class='custom-control-input' id='darkModeSwitch' onclick='darkModeToggle()'>";
		echo "<label class='custom-control-label' for='darkModeSwitch'>Dark Mode</label>";
		echo "</div>";
	}

	public static function loadDropdownItems($userLoggedIn)
	{
		$userLoggedIn = unserialize($userLoggedIn);
		if($userLoggedIn == null)
		{
			echo "<a class='dropdown-item' id='registerNav' href='../User/register.php'>Register</a>";
			echo "<a class='dropdown-item' id='loginNav' href='../User/index.php'>Login</a>";
		}
		else
		{
			if ($userLoggedIn->getLevel() > 1) echo "<a class='dropdown-item' id='managerNav' href='../Manager/index.php'>Manager</a>"; 
			echo "<a class='dropdown-item' id='editAccountNav' data-toggle='modal' data-target='#view-modal' role='button'>Edit Account</a>";
			echo "<a class='dropdown-item' id='logoutNav' href='../User/logout.php'>Logout</a>";
			if($userLoggedIn->getLevel() > 3) echo "<a class='dropdown-item' id='adminNav' href='../User/admin.php'>Admin</a>";
		}
	}
}
?>