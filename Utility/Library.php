<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

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
}