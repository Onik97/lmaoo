<?php 
require("../User/user.php");
require("ticketController.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<title>Ticket</title>
<link rel="stylesheet" href="../Css/ticketPage.css">
<head>
<?php include("../Global/head.php"); ?>
</head>
<?php include("../Global/navBar.php"); ?>
<body> 
	<?php if (isset($userLoggedIn)) 
	{ if(isset($_GET['ticketId']) && ticketExistance($_GET['ticketId'])) 
		{ $ticketId = $_GET['ticketId']; ?>
	
	<div ID="ticketContainer">

			<div ID="ticketDetails">
			<?php include("details.php"); ?>	
    		</div>

    		<div ID="ticketPeople">
			<?php include("people.php"); ?>	
    		</div>

    		<div ID="ticketDate"> 
			<?php include("dates.php"); ?>	
            </div>

	</div>  
		  <div ID="ticketCreate">
		  <?php include("createComment.php"); ?>	
		  </div>
		  
		  <div ID="ticketComments">
		  <?php include("viewComments.php"); ?>	
		  </div>

		  <?php include("../Global/editUserModal.php"); ?>
		  <?php include("ticketModal.php"); ?>
 
<?php } else { echo "<p id='loginMessage'> Ticket ID is invalid! </p>"; }
	} else { echo "<p id='loginMessage'> You need to login to access this page </p>"; } 
	?>
</body>
<footer>
</footer>
</html>