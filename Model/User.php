<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class User extends Database
{
    public function __construct()
    {
        parent::__construct();
        
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct'. $numberOfArguments)) 
		{
            call_user_func_array(array($this, $function), $arguments);
        }
    }

	public function __construct1($githubId) // Login using Github API
	{
        $sql = "SELECT * FROM user WHERE github_id = ?";
        $user = $this->query($sql)->parameters([$githubId])->fetchObject();
        return $user != null ? $user : null;
	}

	public function __construct2($username, $password) // Standard Username and Password Login
	{
        $sql = "SELECT * FROM user WHERE username = ?";
        $userFromDB = $this->query($sql)->parameters([$username])->fetchObject();
        
        if ($userFromDB == null) return; // Username does not exist
        password_verify($password, $userFromDB->password) ? $this->setUser($userFromDB) : null;
	}

    public function setUser($userFromDB)
    {
        $this->id = $userFromDB->userId;
        $this->username = $userFromDB->username;
        $this->forename = $userFromDB->forename;
        $this->surname = $userFromDB->surname;
        $this->level = $userFromDB->level;
        $this->isActive = $userFromDB->isActive;
        $this->picture = $userFromDB->picture;
        $this->darkMode = $userFromDB->darkMode;
        $this->github_id = $userFromDB->github_id;
    }

    public function registerUser($forename, $surname, $username, $hashedPassword)
    {
        $sql = "INSERT INTO user (userId, username, password, forename, surname) VALUES (null, ?, ?, ?, ?)";
        $checker = $this->query($sql)->parameters([$username, $hashedPassword, $forename, $surname])->rowCount();
        return $checker == 1 ? true : false;
    }

    public function getUser(string $userId = null)
    {
        $sql = $userId == null ? "SELECT * FROM user" : "SELECT * FROM user WHERE userId = ?";
        return $userId == null 
        ? $this->query($sql)->fetchAll()
        : $this->query($sql)->parameters([$userId])->fetchObject();
    }

    public function deactivateUser($userId)
    {
        $sql = "UPDATE user SET active = 0 WHERE userId = ?";
        $this->query($sql)->parameters([$userId])->exec();
    }

    public function activateUser($userId)
    {
        $sql = "UPDATE user SET active = 1 WHERE userId = ?";
        $this->query($sql)->parameters([$userId])->exec();
    }

	public function profileToObject($githubUser)
    {
        $this->profilePicture = $githubUser['avatar_url'];
        $this->name = $githubUser['name'];
        $this->login = $githubUser['login'];
    }
}
?>