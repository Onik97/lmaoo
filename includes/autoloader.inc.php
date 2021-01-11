<?php

spl_autoload_register('autoLoader');

function autoLoader($className)
{
    $sources = array("../Controller/" . $className . ".php",
                     "../Utility/" . $className . ".php"
    );

    foreach ($sources as $source) {
        if (file_exists($source)) include $source;
    }
}