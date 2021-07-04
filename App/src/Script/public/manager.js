import Navbar from "../public/navbar.js";
import Project from "../Controller/ProjectController.js";
import notification from "../Utility/NotificationWrapper.js";

$(document).ready(() => { Navbar.accountActiveTab(); })

$("#createProjectBtn").click(async function() {
    let name = $("#projectName").val();
    let status = $("#projectStatus").children("option:selected").val();

    let result = await Project.createProject( {name, status} );
    result == null ? notification.errorMessage("Something went wrong!") : notification.successMessage("User has been updated!");
    $("#createProjectModal").modal("hide");
});