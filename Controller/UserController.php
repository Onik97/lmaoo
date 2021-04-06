<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class UserController 
{
	public static function standardLogin()
	{
		Library::validatePostValues("username", "password");
		$username = $_POST["username"]; $password = $_POST["password"];
		if (Library::hasNull($username, $password)) return Library::redirectWithMessage("Username and Password must be filled in", "/login");

		$user = User::withUsername($username);

		if ($user->userId == null || !password_verify($password, $user->password)) return Library::redirectWithMessage("Username and Password did not match", "../User/login.php");
		if ($user->isActive == 0) return Library::redirectWithMessage("User deactivated, contact the administrator", "../User/login.php");

		if($user->github_id != null)
		{
			$githubController = new GithubController();
			$github = new GithubUser($githubController->getGithubUser($user->github_accessToken));
			$_SESSION['githubProfile'] = $github;
		}

		$_SESSION['userLoggedIn'] = serialize($user);
		header("Location: /");
	}

	public static function logout()
	{
		session_unset();
		session_destroy();
		header("Location: /");
	}

	public function hasDup(?string $unitTest)
	{
		$username = $unitTest == null ? $_POST['username'] : $unitTest;
		$pdo = Library::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT username FROM user WHERE username = ?");
		$stmt->execute([$username]);

		return $stmt->rowCount() > 0 ? true : false;
	}

	public function updateUser($forename, $surname, $username, $userId)
	{
		$pdo = Library::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("UPDATE user SET forename = ?, surname = ?, username = ? WHERE userId = ?");
		$stmt->execute([$forename, $surname, $username, $userId]);

		$userLoggedIn = unserialize($_SESSION["userLoggedIn"]);
		$userLoggedIn->setForename($forename);
		$userLoggedIn->setSurname($surname);
		$userLoggedIn->setUsername($username);
		$_SESSION['userLoggedIn'] = serialize($userLoggedIn);
		Library::redirectWithMessage("Your User Details has been updated", "../Home/index.php"); 
	}

	public function userInfoById($userId) // Should be used for Unit Testing and Admin Only!
	{
		return User::withId($userId);
	}

	public function register($forename, $surname, $username, $password)
	{
		if (Library::hasNull($forename, $surname, $username, $password)) return Library::redirectWithMessage("All Fields must be filled", "../User/register.php");
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

		$user = new User();
		$checker = $user->registerUser($forename, $surname, $username, $hashedPassword);
		
		if ($checker == 1) 
		{
			return Library::redirectWithMessage("Register Successful, Login!", "../User/login.php");
		}
		else
		{
			// TODO: Implement Logging
			return Library::redirectWithMessage("Something went wrong... Try Again later", "../User/login.php");
		}
	}
	
	public function getActiveUsers()
	{
		return User::withActive(1);
	}

	public function getInactiveUsers()
	{
		return User::withActive(0);
	}

	public function darkModeToggle($toggle, $userId)
	{
		$user = new User();
		$user->setDarkMode($toggle, $userId);
	}

	public static function loadDarkMode($userId) // Keeping for Unit Testing
	{
		$user = new User();
		return $user->getDarkMode($userId);
	}

	public function uploadImage($userId)
	{
		$user = new User();

		$target_dir = "../Images/profilePictures/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$ext = pathinfo($target_file, PATHINFO_EXTENSION);
		$rename = $target_dir . $userId . "." . $ext;
		
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
		{
			rename($target_file, $rename);
			$user->setPicture($rename, $userId);
			echo true;
		}
		else echo false;
	}

	public function updatePicture($target, $userId)
	{
		$user = new User();
		$user->setPicture($target, $userId);
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
				$toggle = $userLoggedIn->darkMode;
				setcookie("lmaooDarkMode", $userLoggedIn->darkMode, 0, "/");
			}
		}
		
		echo "<div class='custom-control custom-switch'>";
		echo $toggle == true ? "<input type='checkbox' class='custom-control-input' id='darkModeSwitch' onclick='darkModeToggle()' checked>" : "<input type='checkbox' class='custom-control-input' id='darkModeSwitch' onclick='darkModeToggle()'>";
		echo "<label class='custom-control-label' for='darkModeSwitch'>Dark Mode</label>";
		echo "</div>";
	}
}
