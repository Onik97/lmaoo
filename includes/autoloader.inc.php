<?php spl_autoload_register('autoLoader');

function autoLoader($className)
{
    $paths = array($_SERVER["DOCUMENT_ROOT"] . "lmaoo/Controller/$className.php",
                   $_SERVER["DOCUMENT_ROOT"] . "lmaoo/Utility/$className.php",
                   $_SERVER["DOCUMENT_ROOT"] . "lmaoo/Model/$className.php"); 

    foreach ($paths as $path) if (file_exists($path)) include_once($path); 
    session_start();
}