<?php
if (!isset($userLoggedIn))
{
    $_SESSION['message'] = "Login Required to access Project Page";
    header("Location: ../User/login.php");
}
?>