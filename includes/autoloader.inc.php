<?php spl_autoload_register('autoLoader');

function autoLoader($className)
{
    if (!file_exists(($_SERVER["DOCUMENT_ROOT"] . "lmaoo/config.php"))) die("ERROR:101");
    
    $paths = array($_SERVER["DOCUMENT_ROOT"] . "lmaoo/Controller/$className.php",
                   $_SERVER["DOCUMENT_ROOT"] . "lmaoo/Utility/$className.php",
                   $_SERVER["DOCUMENT_ROOT"] . "lmaoo/Model/$className.php"); 

    foreach ($paths as $path) if (file_exists($path)) include_once($path);
    if (session_status() == PHP_SESSION_NONE) session_start();
}