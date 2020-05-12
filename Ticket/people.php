<script src="../Script/peopleController.js"></script>
<script> 
var ticketId = "<?php echo $ticketId; ?>";
var fullName = "<?php echo $userLoggedIn->getForename() . " " . $userLoggedIn->getSurname() ?>";
</script>
<p ID="ticketPeople1">Reporter: <label id="reporter"><label></p>
<p ID="ticketPeople2">Assignee: <label id="assignee"><label></p>
<button ID="ticketPeopleChooseAssignee" data-toggle="modal" data-target="#CommentModal" onclick="People()">Pick Assignee</button>
<button id="ticketPeopleSelfAssignee" onclick="saveAssigneeAsYourself(ticketId, fullName)">Assigned to myself</button>
<button id="testing" onclick="loadUsers()">Testing</button>

<div ID="dates1">
<h1> Dates </h1>
<p>Created Date:</p> <label id="createDate"></label> <br>
</div>

<div ID="dates2">
<p>Updated Date:</p> <label id="updateDate"></label>
</div>

<script type="text/javascript" src="../Script/dateController.js"></script>