<?php
namespace Lmaoo\Model;

use Lmaoo\Core\Database;
use Lmaoo\Utility\Library;

class User extends Database implements IModel
{
    public static function create(array $data)
    {
        $sql = Library::arrayToInsertQuery("user", $data);
        (new Parent())->db()->query($sql)->parameters([])->exec();
    }

    public static function update($userId, array $data)
    {
        $sql = Library::arrayToUpdateQuery("user", $data);
        (new Parent())->db()->query($sql)->parameters([])->exec();
    }

    public static function delete($userId)
    {
        $sql = "UPDATE user SET active = 0 WHERE userId = ?";
        (new Parent())->db()->query($sql)->parameters([$userId])->exec();
    }

    public static function withId($userId, $columns = null)
    {
        $sql = $columns == null ? "SELECT * FROM user WHERE userId = ?" : "SELECT $columns FROM user";
        return (new Parent())->db()->query($sql)->parameters([$userId])->fetchObject();
    }

    public static function withUsername($username)
    {
        $sql = "SELECT * FROM user WHERE username = ?";
        return (new Parent())->db()->query($sql)->parameters([$username])->fetchObject();
    }

    public static function withGithubId($githubId)
    {
        $sql = "SELECT * FROM user WHERE github_id = ?";
        return (new Parent())->db()->query($sql)->parameters([$githubId])->fetchObject();
    }

    public static function withActive($isActive)
    {
        $sql = $isActive == null ? "SELECT * FROM user" : "SELECT * FROM user WHERE isActive = ?";
        return (new Parent())->db()->query($sql)->parameters([$isActive])->fetchAll();
    }

    public function registerUser($forename, $surname, $username, $hashedPassword)
    {
        $sql = "INSERT INTO user (userId, username, password, forename, surname) VALUES (null, ?, ?, ?, ?)";
        $checker =  (new Parent())->db()->query($sql)->parameters([$username, $hashedPassword, $forename, $surname])->rowCount();
        return $checker == 1 ? true : false;
    }

    public function activateUser($userId)
    {
        $sql = "UPDATE user SET active = 1 WHERE userId = ?";
        (new Parent())->db()->query($sql)->parameters([$userId])->exec();
    }

    public function deactivateUser($userId)
    {
        $sql = "UPDATE user SET active = 0 WHERE userId = ?";
        (new Parent())->db()->query($sql)->parameters([$userId])->exec();
    }

    public function getDarkMode($userId)
    {
        $sql = "SELECT darkMode FROM user WHERE userId = ?";
        $obj = (new Parent())->db()->query($sql)->parameters([$userId])->fetchObject();
        return $obj->darkMode;
    }

    public function setDarkMode($toggle, $userId)
    {
        $sql = "UPDATE user SET darkMode = ? WHERE userId = ?";
        (new Parent())->db()->query($sql)->parameters([$toggle, $userId])->exec();
    }

    public function setPicture($target, $userId)
    {
        $sql = "UPDATE user SET picture = ? WHERE userId = ?";
        (new Parent())->db()->query($sql)->parameters([$target, $userId])->exec();
    }
}