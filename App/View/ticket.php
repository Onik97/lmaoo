<?php include_once(__DIR__ . "/../../Core/Autoloader.php"); $ticket = TicketController::loadTicket(); ?>

<title>Ticket</title>
<p id="navBarActive" hidden>ticketPage</p>

	<div id="ticketActions"></div>

	<div class="row no-gutters">
		<div id="info" class="col-sm-12 col-md-3">
			
			<!-- People Section -->

			<div id="ticketPeople" class="p-4 mx-auto">
			
				<div class="reporterName mb-3">
					<h6>Reporter: </h6>
						<label id="reporter"><?php echo "$ticket->reporter ($ticket->reporterUsername)" ?></label>
						<p id="reporterUserId" hidden><?php echo $ticket->reporterId ?></p>
				</div>

				<div class="assigneeName">
					<h6>Assignee: </h6>
					<label id="assignee"><?php echo "$ticket->assignee ($ticket->assigneeUsername)"?></label>
					<p id="assigneeUserId" hidden><?php echo "$ticket->assigneeId"?></p>
				</div>

				<div class="assigneeBtn">
					<button id="ticketPeopleChooseAssignee" class="btn btn-sm" data-toggle="modal" data-target="#ticketPageModal" onclick="peoplePrompt()">Choose Assignee</button>
					<button id="ticketPeopleSelfAssignee"class="btn btn-sm" onclick="saveAssigneeAsYourself()">Assigned to myself</button>
				</div>
			</div>
			
			<!-- Dates Section -->

			<div id="ticketDates" class=" p-4">

				<div ID="dates1" class="mt-4">
					<h6>Date created:</h6>
					<label id="createDate"><?php echo $ticket->created ?></label>
				</div>

				<div ID="dates2" class="mt-4">
					<h6>Date updated:</h6>
					<label id="updateDate"><?php echo $ticket->updated ?></label>
				</div>
			
			</div>

			<!-- Progress Section -->

			<div class="p-4">
				<label>Ticket Status: <span id="ticketProgress"><?php echo $ticket->progress ?></span></label>
				<button id="changeProgressBtn" class="btn btn-sm" onclick="changeProgress()"></button>
			</div>
		</div>

		<div id="main" class="col-sm-12 col-md-9">

			<!-- Summary Section -->

			<div class="row no-gutters mt-3">
				<div id="ticketHeader"><h1 id="ticketSummaryHeader"><?php echo $ticket->summary ?></h1></div>
			</div>

			<!-- Comment Section -->

			<div class="row no-gutters mt-3">
				<div id="ticketCreate"> 
					<div class="form-group">
						<textarea id="createComment" class="form-control createComment"></textarea>
					</div>
				</div>
			</div>

			<!-- Tabs Section -->

			<ul class="nav nav-tabs my-5" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="comment-tab" data-toggle="tab" href="#comment-content" role="tab" aria-controls="home" aria-selected="true">Comments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes-content" role="tab" aria-controls="profile" aria-selected="false">Notes</a>
				</li>
			</ul>

			<!-- Tabs Divs Section -->

			<div class="tab-content" id="myTabContent">

				<div class="tab-pane fade show active" id="comment-content" role="tabpanel" aria-labelledby="home-tab">

					<!-- Comments Section -->

					<div class="row no-gutters mt-3">
						<div id="ticketComments">
							<h4>All comments</h4>
							<div id="commentList"></div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="notes-content" role="tabpanel" aria-labelledby="profile-tab">

					<!-- Details Section -->

					<div class="row no-gutters mt-3">
						<div id="ticketDetails" class="mt-5 ml-7">							
							<p>Type: </p>
							<p>Status: </p>
							<p>Priority: </p>
							<p>File ID: </p>
							<p>File Description: </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>