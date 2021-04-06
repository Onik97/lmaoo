<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . "/../includes/autoloader.inc.php"); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/notifications.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <script> <?php
    $userController = new UserController();
    if(isset($_SESSION['userLoggedIn'])) 
    {
    $userLoggedIn = unserialize($_SESSION['userLoggedIn']);
    
    echo "const userId = '" . $userLoggedIn->userId . "'\n";
    echo "const userForename = '" . $userLoggedIn->forename. "'\n";
    echo "const userSurname = '" . $userLoggedIn->surname. "'\n";
    echo "const userUsername = '" . $userLoggedIn->username. "'\n";
    echo "const userLevel = '" . $userLoggedIn->level. "'\n";

    if ($userLoggedIn->level > 1)
    {
        echo "const users = " . json_encode($userController->getActiveUsers()) . "\n";
    }
    } 
    ?> </script>
</head>
<body>

<?php echo $navbar; ?>
<?php echo $content; ?>

</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="../Script/server.js"></script>

<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>

<script src="../Script/notifications.js"></script>
<script src="../Script/navBar.js"></script>

<script>

function overHang(type, message)
{
  const myNotification = window.createNotification(
  {
    theme: type,
    showDuration: 3500,
    displayCloseButton: true,
    closeOnClick: true
  });
  
  myNotification({ message: message });
}

const darkmode =  new Darkmode();

</script>
<?php echo $script; ?>
</html>
