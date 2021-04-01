<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class User extends Database
{

    public static function withId($userId, $columns = null)
    {
        $sql = $columns == null ? "SELECT * FROM user WHERE userId = ?" : "SELECT $columns FROM user";
        return self::db()::query($sql)::parameters([$userId])::fetchObject();
    }

    public static function withUsername($username)
    {
        $sql = "SELECT * FROM user WHERE username = ?";
        return self::db()::query($sql)::parameters([$username])::fetchObject();
    }

    public static function withGithubId($githubId)
    {
        $sql = "SELECT * FROM user WHERE github_id = ?";
        return self::db()::query($sql)::parameters([$githubId])::fetchObject();
    }

    public static function withActive($isActive)
    {
        $sql = $isActive == null ? "SELECT * FROM user" : "SELECT * FROM user WHERE isActive = ?";
        return self::db()::query($sql)::parameters([$isActive])::fetchAll();
    }

    public function registerUser($forename, $surname, $username, $hashedPassword)
    {
        $sql = "INSERT INTO user (userId, username, password, forename, surname) VALUES (null, ?, ?, ?, ?)";
        $checker = self::db()::query($sql)::parameters([$username, $hashedPassword, $forename, $surname])::rowCount();
        return $checker == 1 ? true : false;
    }

    public function activateUser($userId)
    {
        $sql = "UPDATE user SET active = 1 WHERE userId = ?";
        self::db()::query($sql)::parameters([$userId])::exec();
    }

    public function deactivateUser($userId)
    {
        $sql = "UPDATE user SET active = 0 WHERE userId = ?";
        self::db()::query($sql)::parameters([$userId])::exec();
    }

    public function getDarkMode($userId)
    {
        $sql = "SELECT darkMode FROM user WHERE userId = ?";
        $obj = self::db()::query($sql)::parameters([$userId])::fetchObject();
        return $obj->darkMode;
    }

    public function setDarkMode($toggle, $userId)
    {
        $sql = "UPDATE user SET darkMode = ? WHERE userId = ?";
        self::db()::query($sql)::parameters([$toggle, $userId])::exec();
    }

    public function setPicture($target, $userId)
    {
        $sql = "UPDATE user SET picture = ? WHERE userId = ?";
        self::db()::query($sql)::parameters([$target, $userId])::exec();
    }
}