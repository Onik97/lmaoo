<?php 
if(!isset($_GET['ticketId']) || !ticketExistance($_GET['ticketId'])) 
{
    echo "<p> Ticket ID not Valid! </p>";
    die; 
}
?>