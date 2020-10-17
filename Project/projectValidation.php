<?php require_once("projectController.php");

$checker = projectExistance();

if ($checker == false)
{
    die("Project ID not valid, go back to the home page");
    return;
}
?>