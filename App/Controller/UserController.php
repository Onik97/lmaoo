<?php
namespace Lmaoo\Controller;

use Lmaoo\Core\Constant;
use Lmaoo\Model\User;
use Lmaoo\Utility\APIResponse;
use Lmaoo\Utility\Library;
use Lmaoo\Utility\Validation;

class UserController extends BaseController
{
	public static function standardLogin()
	{
		$validation = Validation::login($_POST);
		if ($validation != null) return APIResponse::BadRequest($validation);
		$username = $_POST["username"]; $password = $_POST["password"];

		$user = User::read(Constant::$USER_COLUMNS, ["username" => $username])[0];
		if ($user->userId == null || !password_verify($password, $user->password)) return Library::redirectWithMessage("Username and Password did not match", "/login");
		if ($user->isActive == 0) return Library::redirectWithMessage("User deactivated, contact the administrator", "/login");

		$_SESSION['userLoggedIn'] = $user;
		header("Location: /");
	}

	public static function logout()
	{
		session_unset(); session_destroy(); header("Location: /");
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
}
