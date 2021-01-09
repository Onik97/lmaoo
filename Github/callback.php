<?php require_once ("../connection.php"); require_once("githubController.php");
session_start();

if(!isset($_GET['code']) || !isset($_GET['state'])) 
    die(file_get_contents('../Global/404NotFound.php')); 
else if ($_GET['state'] != $_SESSION['state']) 
    die(file_get_contents('../Global/403Forbidden.php'));
else
{
    unset($_SESSION['state']);
    $github = new githubController();
    $github->setAccessToken();
    $id = $github->getGithubId();
    $github->login($id);
}