<?php 
require("../User/user.php");
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
	<div ID="ticketContainer">
	<p><?php if(isset($_GET['ticketId'])) { echo "I got the ticket ID!";} else {}?></p>
			<div ID="ticketBrief">
			<?php include("brief.php"); ?>	
    		</div>

    		<div ID="ticketPeople">
			<?php include("people.php"); ?>	
    		</div>

    		<div ID="ticketDetails">
			<?php include("details.php"); ?>	
    		</div>

    		<div ID="ticketDate"> 
			<?php include("dates.php"); ?>	
            </div>

            <div ID="detailsSubBug">
            <?php include("subBug.php"); ?>	
            </div>

    		<div ID="ticketMessages">
    		<?php include("messages.php"); ?>	
    		</div>
	</div>  
		  <div ID="ticketCreate">
		  <?php include("createComment.php"); ?>	
		  </div>
		  
		  <div ID="ticketComments">
		  <?php include("viewComments.php"); ?>	
		  </div>
		  
		  <?php include("../Global/editUserModal.php"); ?>
		  <?php include("../Global/CreateCommentModal.php"); ?>
<footer>
</footer>
</body>
</html>