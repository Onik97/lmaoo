<?php
namespace Lmaoo\Controller;

use PDO;
use Lmaoo\Model\User;
use Lmaoo\Utility\Library;

class UserController extends BaseController
{
	public static function standardLogin()
	{
		Library::validatePostValues("username", "password");
		$username = $_POST["username"]; $password = $_POST["password"];
		if (Library::hasNull($username, $password)) return Library::redirectWithMessage("Username and Password must be filled in", "/login");

		$user = User::withUsername($username);

		if ($user->userId == null || !password_verify($password, $user->password)) return Library::redirectWithMessage("Username and Password did not match", "../User/login.php");
		if ($user->isActive == 0) return Library::redirectWithMessage("User deactivated, contact the administrator", "../User/login.php");

		$_SESSION['userLoggedIn'] = $user;
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

		$userLoggedIn = $_SESSION(["userLoggedIn"]);
		$userLoggedIn->setForename($forename);
		$userLoggedIn->setSurname($surname);
		$userLoggedIn->setUsername($username);
		$_SESSION['userLoggedIn'] = $userLoggedIn;
		Library::redirectWithMessage("Your User Details has been updated", "../Home/index.php"); 
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
}
