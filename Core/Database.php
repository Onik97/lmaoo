<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/Autoloader.php");

abstract class Database
{
    public static PDO $pdo;
    public static string $query;
    public static array $parameters;

    public static function db()
    {
        $config = include(__DIR__ . "/../config.php");
        self::$pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_table']}", $config['db_username'],  $config['db_password']);
        return new static;
    }

    public static function query($sql)
    {
        self::$query = $sql;
        return new static;
    }

    public static function parameters($parameters)
    {
        self::$parameters = $parameters;
        return new static;
    }

    public static function fetchAll()
    {
        try {
            $pdo = self::$pdo;
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare(self::$query);
            $stmt->execute(self::$parameters);
            $pdo = null; // Closes Connection
            return $stmt->fetchAll();
        }
        catch(PDOException $e) { die("ERROR ID: 102"); }
    }

    public static function fetchObject()
    {
        try {
            $pdo = self::$pdo;
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare(self::$query);
            $stmt->execute(self::$parameters);
            $pdo = null; // Closes Connection
            return $stmt->fetchObject();
        }
        catch(PDOException $e) { die("ERROR ID: 102"); }
    }

    public static function rowCount()
    {
        try {
            $pdo = self::$pdo;
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare(self::$query);
            $stmt->execute(self::$parameters);
            $pdo = null; // Closes Connection
            return $stmt->rowCount();
        }
        catch(PDOException $e) { die("ERROR ID: 102"); }
    }

    public static function exec()
    {
        try {
            $pdo = self::$pdo;
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare(self::$query);
            $stmt->execute(self::$parameters);
            $pdo = null; // Closes Connection
        }
        catch(PDOException $e) { die("ERROR ID: 102"); }
    }
}