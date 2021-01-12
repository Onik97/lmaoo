<?php
session_unset();
session_destroy();
header("Location: index.php"); // Should return to the login page
?>