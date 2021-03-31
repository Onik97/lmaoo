<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class User extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function withId($userId)
    {
        $user = new self();
        return $user->getUserById($userId);
    }

    public function getUserById(string $userId = null)
    {
        $sql = "SELECT * FROM user WHERE userId = ?";
        return $this->query($sql)->parameters([$userId])->fetchObject();
    }

    public static function withUsername($username)
    {
        $user = new self();
        return $user->getUserByUsername($username);
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM user WHERE username = ?";
        return $this->query($sql)->parameters([$username])->fetchObject();
    }

    public static function withGithubId($githubId)
    {
        $user = new self();
        return $user->getUserByGithubId($githubId);
    }

    public function getUserByGithubId($githubId)
    {
        $sql = "SELECT * FROM user WHERE github_id = ?";
        return $this->query($sql)->parameters([$githubId])->fetchObject();
    }

    public static function withActive($isActive)
    {
        $user = new self();
        return $user->getUsers($isActive);
    }

    public function getUsers($isActive = null)
    {
        $sql = $isActive == null ? "SELECT * FROM user" : "SELECT * FROM user WHERE isActive = ?";
        return $this->query($sql)->parameters([$isActive])->fetchAll();
    }

    public function registerUser($forename, $surname, $username, $hashedPassword)
    {
        $sql = "INSERT INTO user (userId, username, password, forename, surname) VALUES (null, ?, ?, ?, ?)";
        $checker = $this->query($sql)->parameters([$username, $hashedPassword, $forename, $surname])->rowCount();
        return $checker == 1 ? true : false;
    }

    public function activateUser($userId)
    {
        $sql = "UPDATE user SET active = 1 WHERE userId = ?";
        $this->query($sql)->parameters([$userId])->exec();
    }

    public function deactivateUser($userId)
    {
        $sql = "UPDATE user SET active = 0 WHERE userId = ?";
        $this->query($sql)->parameters([$userId])->exec();
    }

    public function getDarkMode($userId)
    {
        $sql = "SELECT darkMode FROM user WHERE userId = ?";
        return $this->query($sql)->parameters([$userId])->fetchObject()->darkMode;
    }

    public function setDarkMode($toggle, $userId)
    {
        $sql = "UPDATE user SET darkMode = ? WHERE userId = ?";
        $this->query($sql)->parameters([$toggle, $userId])->exec();
    }

    public function setPicture($target, $userId)
    {
        $sql = "UPDATE user SET picture = ? WHERE userId = ?";
        $this->query($sql)->parameters([$target, $userId])->exec();
    }
}