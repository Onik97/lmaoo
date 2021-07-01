import TicketController from "../Controller/TicketController.js";
import Navbar from "../public/navbar.js";
import Notification from "../Utility/NotificationWrapper.js";
import Summernote from "../Utility/SummernoteWrapper.js";
import WebComponent from "../Utility/WebComponent.js";

Navbar.projectActiveTab();
let ticketId = window.location.href.split('?')[0].split("/").reverse()[0];

// Create Comment Summernote
let createCommentSummernote = new Summernote(".createComment", "Enter your comment here, CTRL + Enter to save")
createCommentSummernote.onKeyDown(async (commentContent) => {
    let result = await TicketController.createComment({ commentContent, ticketId });
    createCommentSummernote.setValue("");
    WebComponent.Comment("#commentList", result);
    Notification.successMessage("New Comment added Successfully!")
});

// Edit Comment Summernote
$(document).on('click', '.CommentImages.editComment', async function() {
    let commentId = $(this).attr("value");
    let editCommentSummernote = new Summernote(`#mainComment${commentId}`);
    editCommentSummernote.onKeyDown(async (commentContent) => {
        await TicketController.updateComment({ commentContent, ticketId, commentId });
        Notification.successMessage("Comment adjusted successfully!")
        editCommentSummernote.Close();
    }, (initalValue) => editCommentSummernote.setValue(initalValue).Close());
});

// Delete Comment
$(document).on('click', '.CommentImages.deleteComment', async function() {
    let commentId = $(this).attr("value");
    await TicketController.deleteComment(commentId);
    Notification.successMessage("Comment removed!");
    $(this).parent().parent().remove();
});

// Loads users on Choose Assignee Modal
$("#chooseAssigneeBtn").click(async function() {
    let assignees = await TicketController.loadAssignees();
    WebComponent.Assignee("#assigneeSelect", assignees);
});

// Save Assignee on Choose Assignee Modal
$("#saveAssigneeBtn").click(async function() {
    let assignee_key = $("#assigneeSelect").val();
    let result = await TicketController.updateTicket({ ticketId, assignee_key })
    let { assignee, assigneeUsername, assigneeId } = result;
    $("#assignee").val(assigneeId).html(`${assignee} (${assigneeUsername})`);
    Notification.successMessage("Assignee Updated!");
    $("#ticketPageModal").modal('hide');
});

$("#selfAssigneeBtn").click(async function() {
    let selfAssignee = $("#assigneeSelect").val();
    let result = await TicketController.updateTicket({ ticketId, selfAssignee })
    let { assignee, assigneeUsername, assigneeId } = result;
    $("#assignee").val(assigneeId).html(`${assignee} (${assigneeUsername})`);
    Notification.successMessage("Assigned to self!");
});