<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../Core/Autoloader.php");

class Library 
{
    public static function logindb()
	{
        $config = include (__DIR__ . "/../config.php");
        try
		{
			$pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_table']}", $config['db_username'],  $config['db_password']);
		}
		catch(PDOException $e)
		{
			die("ERROR ID: 102");
		}
		return $pdo;
    }

    public static function generateString($length)
    {
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) throw new Exception('$keyspace must be at least two characters long'); 
        for ($i = 0; $i < $length; ++$i) $str .= $keyspace[random_int(0, $max)];
        return $str;
    }

    public static function notFoundMessage()
    {
        die(file_get_contents(__DIR__ . "/../includes/notFound.php"));
        return null;
    }

    public static function forbiddenMessage()
    {
        die(file_get_contents(__DIR__ . "/../includes/forbidden.php"));
        return null;
    }

    public static function redirectWithMessage($message, $url)
    {
        $_SESSION['message'] = $message;
        header("Location: $url");
    }

    public static function hasNull(...$values)
    {
        foreach($values as $value) 
        {
            if ($value == null) return true;
        }
        return false;
    }

    public static function validatePostValues(...$args) 
    {
        $post = array_keys($_POST);
        $keys = array_values($args);
        $result = array_diff($keys, $post);
        if(count($result) == 0) return;
        
        $message = "Following information is missing: ";
        foreach($result as $value) {
            $message = $message . "$value ";
        }
        http_response_code(400);
        exit($message);
    }

    public static function arrayToInsertQuery(string $tableName, array $data)
    {
        $keys = "";
        $values = "";

        foreach($data as $x => $y) {
            $keys = $keys . "$x,";
            $values = $values . "$y,";
        }
        $keys = substr($keys, 0, -1);
        $values = substr($values, 0, -1);

        return "INSERT INTO $tableName ($keys) VALUES ($values)";
    }

    public static function arrayToUpdateQuery(string $tableName, array $data)
    {
        $updates = "";

        foreach($data as $x => $y) {
            $updates = $updates . "$x = $y,";
        }
        $keys = substr($updates, 0, -1);

        return "INSERT INTO $tableName SET $updates";
    }
}