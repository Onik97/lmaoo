<?php use Lmaoo\Core\Render; use Lmaoo\Utility\Session; ?>
<title>Ticket</title>
<p id="navBarActive" hidden>ticketPage</p>

<div id="ticketActions"></div>

<div class="row no-gutters">
	<div id="info" class="col-sm-12 col-md-3">

		<!-- People Section -->

		<div id="ticketPeople" class="p-4 mx-auto">

			<div class="reporterName mb-3">
				<h6>Reporter: </h6>
				<label id="reporter"><?php echo Session::Get('ticket')->reporter . "(" . Session::Get('ticket')->reporterUsername . ")" ?></label>
				<p id="reporterUserId" hidden><?php echo Session::Get('ticket')->reporterId ?></p>
			</div>

			<div class="assigneeName">
				<h6>Assignee: </h6>
				<label id="assignee"><?php echo Session::Get('ticket')->assignee . " (" . Session::Get('ticket')->assigneeUsername . ")" ?></label>
				<p id="assigneeUserId" hidden><?php echo "Session::Get('ticket')->assigneeId" ?></p>
			</div>

			<div class="assigneeBtn">
				<button id="chooseAssigneeBtn" class="btn btn-sm" data-toggle="modal" data-target="#ticketPageModal">Choose Assignee</button>
				<button id="selfAssigneeBtn" class="btn btn-sm">Assigned to myself</button>
			</div>
		</div>

		<!-- Dates Section -->

		<div id="ticketDates" class=" p-4">

			<div ID="dates1" class="mt-4">
				<h6>Date created:</h6>
				<label id="createDate"><?php echo Session::Get('ticket')->created ?></label>
			</div>

			<div ID="dates2" class="mt-4">
				<h6>Date updated:</h6>
				<label id="updateDate"><?php echo Session::Get('ticket')->updated ?></label>
			</div>

		</div>

		<!-- Progress Section -->

		<div class="p-4">
			<label>Ticket Status: <span id="ticketProgress"><?php echo Session::Get('ticket')->progress ?></span></label>
			<button id="changeProgressBtn" class="btn btn-sm"></button>
		</div>
	</div>

	<div id="main" class="col-sm-12 col-md-9">

		<!-- Summary Section -->

		<div class="row no-gutters mt-3">
			<div id="ticketHeader">
				<h1 id="ticketSummaryHeader"><?php echo Session::Get('ticket')->summary ?></h1>
			</div>
		</div>

		<!-- Create Comment Section -->

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
						<div id="commentList">
							<?php Render::Comment(Session::Get("ticket")->ticketId); ?>
						</div>
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

<!-- CHOOSE ASSIGNEE MODAL -->
<div class="modal fade" id="ticketPageModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title ml-9 mr-auto" id="Modal-head">Choose Assignee</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<div class="modal-body" id="ticketPageBody">
				<select id="assigneeSelect" class="form-control" >
					<option value="0" selected disabled>Select user</option>
				</select>
			</div>
			<div class="modal-footer" id="ticketPageFooter">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" id="saveButton">Save changes</button>
			</div>
		</div>
	</div>
</div>