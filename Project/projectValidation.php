<?php require_once("projectController.php");

$projectController = new projectController();
$checker = $projectController->projectExistance(null);

if ($checker == false)
{
    echo "Project ID not valid, go back to the home page";
    die;
}
?>