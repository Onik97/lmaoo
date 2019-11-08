<?php require("../User/user.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ticket</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Css/ticketPage.css">
<head></head>
<?php include("../Global/navBar.php"); ?>
<body>
	<div ID="ticketContainer">
			
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
<footer>
</footer>

</body>
</html>