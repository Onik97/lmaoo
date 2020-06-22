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
<p id="navBarActive" hidden>ticketPage</p>
</head>
<?php include("../Global/navBar.php"); ?>
<body>
	<?php if (isset($userLoggedIn)) 
	{ if(isset($_GET['ticketId']) && ticketExistance($_GET['ticketId'])) 
		{ $ticketId = $_GET['ticketId']; ?>

	<div id="ticketActions"></div>
	

		<div class="row no-gutters">
			<div class="col-3">
				<div id="ticketPeople">
					<?php include("people.php"); ?>
				</div>
				<div id="ticketDates">
					<?php include("dates.php"); ?>
				</div>
			</div>

			<div class="col-9">
				<div class="row no-gutters">
					<div id="ticketDetails">
						<?php include("details.php"); ?>
					</div>
				</div>

					<div class="row no-gutters">
						<div id="ticketCreateComment">
							<?php include("createComment.php"); ?>	
						</div>
					</div>

					<div class="row no-gutters">
						<div id="ticketComments">
		  					<?php include("viewComments.php"); ?>	
		  				</div>
					</div>
			</div>
		</div>
	
		<?php include("../Global/editUserModal.php"); ?>
		<?php include("ticketModal.php"); ?>
		<?php } else { echo "<p id='loginMessage'> Ticket ID is invalid! </p>"; }
			} else { echo "<p id='loginMessage'> You need to login to access this page </p>"; } 
			?>
</body>
</html>