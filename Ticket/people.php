<script src="../Script/peopleController.js"></script>

<h3>Reporter: </h3>
    <label id="reporter"></label>
    <p id="reporterUserId" hidden></p>

<h3>Assignee: </h3>
    <label id="assignee"></label>
    <p id="assigneeUserId" hidden></p>

<button id="ticketPeopleChooseAssignee" data-toggle="modal" data-target="#CommentModal" onclick="People()">Pick Assignee</button>
<button id="ticketPeopleSelfAssignee" onclick="saveAssigneeAsYourself()">Assigned to myself</button>