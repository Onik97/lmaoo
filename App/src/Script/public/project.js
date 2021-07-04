import Navbar from "../public/navbar.js";
import Fragment from "../Utility/Fragment.js";
import Project from "../Controller/ProjectController.js";
import notification from "../Utility/NotificationWrapper.js";

$(document).ready(() => { Navbar.projectActiveTab(); });
let projectIdData = window.location.href.split('?')[0].split("/").reverse()[0];
let projectId = Number(projectIdData);

$("#createFeatureButton").click(async function(){
    let name = $("#featureName").val();
    let result = await Project.createFeature({projectId, name});

    result == null ? notification.errorMessage("Something went wrong!") : notification.successMessage("Feature has been created!");
    $("#createFeatureModal").modal("hide");
});
