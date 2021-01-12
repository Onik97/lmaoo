<?php require("../User/user.php"); ?>

<!DOCTYPE html>

<head>
	<title>Ticket</title>
	<p id="navBarActive" hidden>ticketPage</p>
	<link rel="stylesheet" href="../Css/ticketPage.css">
	<?php include("../Global/head.php"); ?>
</head>

<body>
	<?php include("../Global/navBar.php"); ?>
	<?php include("../Global/loginCheck.php"); ?>
	<?php include("../Ticket/ticketValidation.php"); ?>

	<div id="ticketActions"></div>

	<div class="row no-gutters">
		<div id="info" class="col-sm-12 col-md-3">
			<div id="ticketPeople" class="p-4 mx-auto"> <?php include("people.php"); ?> </div>
			<div id="ticketDates" class=" p-4"> <?php include("dates.php"); ?> </div>
		</div>

		<div id="main" class="col-sm-12 col-md-9">
			<h1>Ticket name: </h1>

			<div class="row no-gutters mt-3">
				<div id="ticketCreate"> <?php include("createComment.php"); ?></div>
			</div>

			<ul class="nav nav-tabs my-5" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="comment-tab" data-toggle="tab" href="#comment-content" role="tab" aria-controls="home" aria-selected="true">Comments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes-content" role="tab" aria-controls="profile" aria-selected="false">Notes</a>
				</li>
			</ul>

			<div class="tab-content" id="myTabContent">

				<div class="tab-pane fade show active" id="comment-content" role="tabpanel" aria-labelledby="home-tab">
					<div class="row no-gutters mt-3">
						<div id="ticketComments"><?php include("viewComments.php"); ?></div>
					</div>
				</div>

				<div class="tab-pane fade" id="notes-content" role="tabpanel" aria-labelledby="profile-tab">
					<div class="row no-gutters mt-3">
						<div id="ticketDetails" class="mt-5 ml-7"><?php include("details.php"); ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("../Global/scripts.php"); ?>
	<?php include("../Global/editUserModal.php"); ?>
	<?php include("ticketModal.php"); ?>
	<script src="../Script/peopleController.js"></script>
	<script type="text/javascript" src="../Script/commentController.js"></script>
	<script type="text/javascript" src="../Script/dateController.js"></script>
</body>

</html>