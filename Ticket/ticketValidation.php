<?php 
if(!isset($_GET['ticketId']) || !ticketIdExistance($_GET['ticketId'])) 
{
    echo "<p> Ticket ID not Valid! </p>";
    die; 
}
?>