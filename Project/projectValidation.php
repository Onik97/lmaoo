<?php require_once("projectController.php");

$checker = projectExistance();

if ($checker == false)
{
    echo "Project ID not valid, go back to the home page";
    die;
}
?>