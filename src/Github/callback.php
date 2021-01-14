<?php require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); session_start();

if(!isset($_GET['code']) || !isset($_GET['state'])) 
    die(file_get_contents('../../includes/notFound.php')); 
else if ($_GET['state'] != $_SESSION['state']) 
    die(file_get_contents('../../includes/forbidden.php')); 
else
{
    unset($_SESSION['state']);
    $github = new GithubController();
    $userController = new UserController();

    switch ($_GET['function']) 
    {
        case "login":
            $github->setAccessToken();
            $githubUser = $github->getGithubUser($github->getAccessToken());
            $github->saveAccessToken($githubUser);
            $userController->login("", "", $githubUser);
            break;
        case "register":
            $github->setAccessToken();
            $github->registerGithub();
            break;
    }
}