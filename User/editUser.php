<?php 
require("../User/user.php");
session_start();
$userLoggedIn = $_SESSION['userLoggedIn'];
echo "Your name is " . $userLoggedIn->getForename() . " " . $userLoggedIn->getSurname();
echo " Your account cannot be edited at this moment, please go back and try again later";
?>
<br>
<button onclick="goBack()">Go Back</button>
<script>
function goBack() {
   window.history.back();
}
</script>