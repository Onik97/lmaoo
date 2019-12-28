<script src="../Script/peopleController.js"></script>
<script> 
var ticketId = "<?php echo $ticketId; ?>";
var fullName = "<?php echo $userLoggedIn->getForename() . " " . $userLoggedIn->getSurname() ?>";
</script>
<p ID="ticketPeople1">Reporter: <label id="reporter"><label></p>
<p ID="ticketPeople2">Assignee: <label id="assignee"><label></p>
<button ID="ticketPeople3" data-toggle="modal" data-target="#CommentModal" onclick="People()">People(wip)</button>
<button id="ticketPeople3" onclick="saveAssigneeAsYourself(ticketId, fullName)">Assigned to myself</button>