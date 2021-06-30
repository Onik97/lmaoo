import TicketController from "../Controller/TicketController.js";
import Navbar from "../public/navbar.js";
import SummernoteWrapper from "../Utility/SummernoteWrapper.js";
import WebComponent from "../Utility/WebComponent.js";

Navbar.projectActiveTab();
SummernoteWrapper.Load(".createComment", "Enter your comment here, Shift + Enter to save");

// Loads users on Choose Assignee Modal
$("#chooseAssigneeBtn").click(async function() {
    let assignees = await TicketController.loadAssignees();
    WebComponent.Assignee("#assigneeSelect", assignees);
});