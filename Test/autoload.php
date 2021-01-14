<?php spl_autoload_register('autoLoader');

function autoLoader($className)
{
    //error_reporting(0);
    
    if (!file_exists((__DIR__ . "/../config.php"))) die("ERROR: 101");
    
    $paths = array(__DIR__ . "/../Controller/$className.php",
                   __DIR__ . "/../Utility/$className.php",
                   __DIR__ . "/../Model/$className.php");

    foreach ($paths as $path) if (file_exists($path)) include_once($path);
    if (!defined('directAccessValidator')) define('directAccessValidator', true);
}