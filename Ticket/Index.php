<?php require("../User/user.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ticket</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Css/ticketPage.css">
<head></head>
<?php include("../Global/navBar.php"); ?>
<body>
	<div ID="ticketContainer">
    		<div ID="ticketBrief">
    		<p ID="ticketBrief1"> Project Name:            '' </p>
			<p ID="ticketBrief2"> Ticket ID:               '' </p> 
			<p ID="ticketBrief3"> Ticket Name:             '' </p>
 
    		</div>

    		<div ID="ticketPeople">
    		  <p ID="ticketPeople1"> Reporter:  '[]' </p>
			  <p ID="ticketPeople2"> Assignee:  '[]' </p>
			  <a ID="ticketPeople3" href=""> Click here to assign it to yourself </a>
    		</div>

    		<div ID="ticketDetails">
    		  <h1 align=""> Details </h1>
    		</div>

    		<div ID="ticketDate"> 
    		  <h1> Dates </h1>
                
                <div ID="dates1">   
                <p>Created Date:</p> <br>
                <p>Start Date:</p> <br>
                </div>
    		    <div ID="dates2">
                <p>Updated Date:</p> <br>
                <p>Deadline:</p> <br> 
                </div>

            </div>

            <div ID="detailsSubBug">
            <h1>Sub Bug</h1>
            </div>

    		<div ID="ticketMessages">
    		<h1> Dev Messages </h1>
    		</div>
	</div>
		  <div ID="ticketCreate">
		      <h1> Comment Creator <h1>
		  </div>
		  <div ID="ticketComments">
		      <h1> Comment Section </h1>
		  </div>
<footer>
</footer>

</body>
</html>