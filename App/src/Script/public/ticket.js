import TicketController from "../Controller/TicketController.js";
import Navbar from "../public/navbar.js";
import axios from "../Utility/AxiosWrapper.js";
import NotificationWrapper from "../Utility/NotificationWrapper.js";
import Summernote from "../Utility/SummernoteWrapper.js";
import WebComponent from "../Utility/WebComponent.js";

Navbar.projectActiveTab();

// Create Comment Summernote
let createCommentSummernote = new Summernote(".createComment", "Enter your comment here, CTRL + Enter to save")
createCommentSummernote.onKeyDown(async (commentContent) => {
    let ticketId = window.location.href.split('?')[0].split("/").reverse()[0];
    let result = await axios.Post("/ticket/comment", { commentContent, ticketId });
    createCommentSummernote.setValue("");
    WebComponent.Comment("#commentList", result);
    NotificationWrapper.successMessage("New Comment added Successfully!")
});

// Loads users on Choose Assignee Modal
$("#chooseAssigneeBtn").click(async function() {
    let assignees = await TicketController.loadAssignees();
    WebComponent.Assignee("#assigneeSelect", assignees);
});