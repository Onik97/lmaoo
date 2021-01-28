<?php if(!defined('directAccessValidator')) { die(file_get_contents('../../includes/notFound.php')); return; } ?>

<div class="reporterName mb-3">
    <h6>Reporter: </h6>
        <label id="reporter"></label>
        <p id="reporterUserId" hidden></p>
</div>

<div class="assigneeName">
    <h6>Assignee: </h6>
        <label id="assignee"></label>
        <p id="assigneeUserId" hidden></p>
</div>

<div class="assigneeBtn">
    <button id="ticketPeopleChooseAssignee" class="btn btn-sm" data-toggle="modal" data-target="#ticketPageModal" onclick="peoplePrompt()">Choose Assignee</button>
    <button id="ticketPeopleSelfAssignee"class="btn btn-sm" onclick="saveAssigneeAsYourself()">Assigned to myself</button>
</div>