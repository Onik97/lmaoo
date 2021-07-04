<?php
namespace Lmaoo\Core;

use PDO;
use PDOException;
use Lmaoo\Core\Config;

class Database extends Config
{
    public static PDO $pdo;
    public static string $query;
    public static array $parameters;

    public function db()
    {
        $this::$pdo = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_table,
                        $this->db_username, 
                        $this->db_password);
        return $this;
    }

    public function query($sql)
    {
        $this::$query = $sql;
        return $this;
    }

    public function parameters($parameters)
    {
        $this::$parameters = $parameters;
        return $this;
    }

    public function fetchAll()
    {
        try {
            $pdo = $this::$pdo;
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare($this::$query);
            $stmt->execute($this::$parameters);
            $pdo = null; // Closes Connection
            return $stmt->fetchAll();
        }
        catch(PDOException $e) { die("ERROR ID: 102"); }
    }

    public function fetchObject()
    {
        try {
            $pdo = $this::$pdo;
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare($this::$query);
            $stmt->execute($this::$parameters);
            $pdo = null; // Closes Connection
            return $stmt->fetchObject();
        }
        catch(PDOException $e) { die("ERROR ID: 102"); }
    }

    public function rowCount()
    {
        try {
            $pdo = $this::$pdo;
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare($this::$query);
            $stmt->execute($this::$parameters);
            $pdo = null; // Closes Connection
            return $stmt->rowCount();
        }
        catch(PDOException $e) { die("ERROR ID: 102"); }
    }

    public function exec()
    {
        try {
            $pdo = $this::$pdo;
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare($this::$query);
            $stmt->execute($this::$parameters);
            $pdo = null; // Closes Connection
        }
        catch(PDOException $e) { die("ERROR ID: 102"); }
    }

    public function getLast()
    {
        try {
            $pdo = $this::$pdo;
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare($this::$query);
            $stmt->execute($this::$parameters);
            $id = $pdo->lastInsertId();
            $pdo = null; // Closes Connection
            return $id;
        }
        catch(PDOException $e) { die("ERROR ID: 102"); }
    }
}
