<?php
$ticketController = new ticketController();
if(!isset($_GET['ticketId']) || !$ticketController->ticketIdExistance($_GET['ticketId'])) 
{
    echo "<p> Ticket ID not Valid! </p>";
    die; 
}
?>