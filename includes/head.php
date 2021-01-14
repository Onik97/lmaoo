<?php include_once(__DIR__ . "/../includes/autoloader.inc.php"); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="../Css/notifications.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<script> <?php
$userController = new userController();
if(isset($_SESSION['userLoggedIn'])) 
{
  $userLoggedIn = unserialize($_SESSION['userLoggedIn']);
  
  echo "const userId = '" . $userLoggedIn->getId() . "'\n";
  echo "const userForename = '" . $userLoggedIn->getForename(). "'\n";
  echo "const userSurname = '" . $userLoggedIn->getSurname(). "'\n";
  echo "const userUsername = '" . $userLoggedIn->getUsername(). "'\n";
  echo "const userLevel = '" . $userLoggedIn->getLevel(). "'\n";

  if ($userLoggedIn->getLevel() > 1)
  {
    echo "const users = " . json_encode($userController->getActiveUsers()) . "\n";
  }
} 
?> </script>