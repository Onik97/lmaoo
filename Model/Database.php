<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class Database
{
    function __construct()
	{
        $this->config = include(__DIR__ . "/../config.php");
        $this->query = null;
        $this->parameters = null;
    }

    public function query($sql)
    {
        $this->query = $sql;
        return $this;
    }

    function parameters($parameters)
    {
        if (!is_array($parameters)) die("Error ID: 103");
        $this->parameters = $parameters;
        return $this;
    }

    function fetchAll()
    {
        try 
        {
            $pdo = new PDO("mysql:host={$this->config['db_host']};dbname={$this->config['db_table']}", $this->config['db_username'],  $this->config['db_password']);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare($this->query);
            $stmt->execute($this->parameters);
            $pdo = null; // Closes Connection
            return $stmt->fetchAll();
        }
        catch(PDOException $e)
		{
			die("ERROR ID: 102");
		}
    }
    
    function fetchObject()
    {
        try 
        {
            $pdo = new PDO("mysql:host={$this->config['db_host']};dbname={$this->config['db_table']}", $this->config['db_username'],  $this->config['db_password']);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare($this->query);
            $stmt->execute($this->parameters);
            $pdo = null; // Closes Connection
            return $stmt->fetchObject();
        }
        catch(PDOException $e)
		{
			die("ERROR ID: 102");
		}
    }

    function rowCount()
    {
        try 
        {
            $pdo = new PDO("mysql:host={$this->config['db_host']};dbname={$this->config['db_table']}", $this->config['db_username'],  $this->config['db_password']);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare($this->query);
            $stmt->execute($this->parameters);
            $pdo = null; // Closes Connection
            return $stmt->rowCount();
        }
        catch(PDOException $e)
		{
			die("ERROR ID: 102");
		}
    }

    function exec()
    {
        try 
        {
            $pdo = new PDO("mysql:host={$this->config['db_host']};dbname={$this->config['db_table']}", $this->config['db_username'],  $this->config['db_password']);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $stmt = $pdo->prepare($this->query);
            $stmt->execute($this->parameters);
            $pdo = null; // Closes Connection
        }
        catch(PDOException $e)
		{
			die("ERROR ID: 102");
		}
    }
}