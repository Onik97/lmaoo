import TicketController from "../Controller/TicketController.js";
import Navbar from "../public/navbar.js";
import NotificationWrapper from "../Utility/NotificationWrapper.js";
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
    NotificationWrapper.successMessage("New Comment added Successfully!")
});

// Loads users on Choose Assignee Modal
$("#chooseAssigneeBtn").click(async function() {
    let assignees = await TicketController.loadAssignees();
    WebComponent.Assignee("#assigneeSelect", assignees);
});