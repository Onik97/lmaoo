import Navbar from "../public/navbar.js";
import Fragment from "../Utility/Fragment.js";
import notification from "../Utility/NotificationWrapper.js";
import WebComponent from "../Utility/WebComponent.js";
import Feature from "../Controller/featureController.js";

Navbar.projectActiveTab();

let projectIdData = window.location.href.split('?')[0].split("/").reverse()[0]; // gets ProjectId form URL
let projectId = Number(projectIdData); // converts into a Int to pass validation

// create Feature
$("#createFeatureButton").click(async function() {
    let name = $("#featureName").val();
    let result = await Feature.createFeature({ projectId, name });

    result == null ? notification.errorMessage("Something went wrong!") : notification.successMessage("Feature has been created!");
    WebComponent.Feature("#activeFeatures", result[0]);
    $("#createFeatureModal").modal("hide");
});

// read Features (active & inactive)
$("#featureToggle").click(function(){
    if ($('#featureToggle').is(":checked"))
    {
        $("#inactiveFeatures").hide();
        $("#activeFeatures").show();
    }
    else
    {
        $("#activeFeatures").hide();
        $("#inactiveFeatures").show();
    }
});

// using this to get the featureId for editFeatures
$(document).on('click', '.far.fa-edit', function() {
    let featureIddata = $(this).attr('value');
    $("#editFeatureButton").val(featureIddata)
})

// Edit Feature
$("#editFeatureButton").click(async function(){
    let name = $("#newFeatureName").val();
    let data = $(this).attr('value');
    var featureId = parseInt(data, 10);
    let active = $("#editFeatureToggle").is(":checked") ? 1 : 0;
    
    let result = await Project.updateFeature({featureId,name, active})
    result == null ? notification.errorMessage("Something went wrong!"): notification.successMessage("Feature has been updated!");
    $("#editFeatureModal").modal("hide");
});