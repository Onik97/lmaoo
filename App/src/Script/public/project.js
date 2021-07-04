import Navbar from "../public/navbar.js";
import Fragment from "../Utility/Fragment.js";
import Project from "../Controller/ProjectController.js";
import notification from "../Utility/NotificationWrapper.js";

$(document).ready(() => { Navbar.projectActiveTab(); });
let projectIdData = window.location.href.split('?')[0].split("/").reverse()[0];
let projectId = Number(projectIdData);

$("#createFeatureButton").click(async function(){
