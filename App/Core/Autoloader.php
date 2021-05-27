<?php spl_autoload_register('autoLoader');

function autoLoader($className)
{
    if (!file_exists((__DIR__ . "/../config.php"))) exit("ERROR: 101");
    
    $paths = array( __DIR__ . "/$className.php",
                    __DIR__ . "/../Controller/$className.php",
                    __DIR__ . "/../Utility/$className.php",
                    __DIR__ . "/../Model/$className.php");

    foreach ($paths as $path) if (file_exists($path)) include_once($path);
    if (session_status() == PHP_SESSION_NONE) session_start();
    if (!defined('directAccessValidator')) define('directAccessValidator', true);
}