import TicketController from "../Controller/TicketController.js";
import Navbar from "../public/navbar.js";
import axios from "../Utility/AxiosWrapper.js";
import NotificationWrapper from "../Utility/NotificationWrapper.js";
import Summernote from "../Utility/SummernoteWrapper.js";
import WebComponent from "../Utility/WebComponent.js";

Navbar.projectActiveTab();
let createCommentSummernote = new Summernote(".createComment", "Enter your comment here, CTRL + Enter to save");

// Loads users on Choose Assignee Modal
$("#chooseAssigneeBtn").click(async function() {
    let assignees = await TicketController.loadAssignees();
    WebComponent.Assignee("#assigneeSelect", assignees);
});

// Create Comment Summernote
createCommentSummernote.onKeyDown(async () => {
    let commentContent = createCommentSummernote.getValue();
    let ticketId = window.location.href.split('?')[0].split("/").reverse()[0];
    let result = await axios.Post("/ticket/comment", { commentContent, ticketId });
    createCommentSummernote.setValue("");
    WebComponent.Comment("#commentList", result);
    NotificationWrapper.successMessage("New Comment added Successfully!")
});