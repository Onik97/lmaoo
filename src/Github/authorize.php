<?php require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); 

$config = require("../../config.php");
// To prevent CSRF attacks
$str = Library::generateString(10);
$_SESSION['state'] = $str;
header("Location: https://github.com/login/oauth/authorize?client_id={$config['github_clientId']}&scope=user%20repo%20admin%3Apublic_key%20admin%3Arepo_hook%20admin%3Aorg_hook%20gist%20notifications%20&state={$_SESSION['state']}&redirect_uri={$config['github_request_uri']}?function={$_GET['function']}");
?>