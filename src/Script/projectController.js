$(document).ready(function() 
{
    loadFeatures();
}); 

function loadFeatures()
{
    $("#listOfFeatures").find("li:gt(0)").remove();
    var projectId = new URL(window.location.href).searchParams.get("projectId");
    loadFeaturesFromServer(projectId)
    .then(response =>
    {

        if (userLevel >= 3) $("#listOfFeatures").append($("<div>", { id : "createFeatureBtn" , "data-toggle" : "modal" , "data-target" : "#featureModal" , onclick : "createFeaturePrompt()"}).html(" + Create Feature"));

        var json = response.data;
        for (i = 0; i < json.length; i++)
        {
            $("#listOfFeatures").append($("<li>", { value : json[i].featureId , onclick : "getProjectName(this.innerHTML, this.value); loadTicketsWithProgress('Open');"}).html(json[i].name));
        }

        if (userLevel >= 3) $("#listOfFeatures").append($("<div>", { id : "editFeatureBtn" , "data-toggle" : "modal" , "data-target" : "#featureModal" , onclick : "activateFeaturePrompt()"}).html("Activate Feature"));
    })
}

function getProjectName(name, id)
{
    $("#ticketMessage").html("Tickets for " + name);
    $("#selectedFeatureId").html(id);
}

function createFeaturePrompt()
{
    $("#featureModalTitle").html("Create Feature");

    let featureNameDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let featureNameLabel = $("<label>").html("Feature Name:");
    let featureNameInput = $("<input>", {class : "form-control", type : "text", id : "featureName", onkeyup : "featureValidation()"});
    let featureValidationSmall = $("<small>", {id : "featureValidationSmall"});
    $("#featureModalBody").html("").append(featureNameDiv);
    $(featureNameDiv).append(featureNameLabel);
    $(featureNameDiv).append(featureNameInput);
    $(featureNameDiv).append(featureValidationSmall);

    $("#featureModalFooter").html("").append($("<button>", {class : "btn btn-primary", type : "text", id : "saveFeatureBtn", onclick : "createFeature()"}).html("Save"));
    $('#saveFeatureBtn').prop('disabled', true); 
}

function featureValidation()
{
    var projectId = new URL(window.location.href).searchParams.get("projectId");
    var data = new FormData();
    data.append("function", "checkFeatureExistance");
    data.append("featureName", $.trim($("#featureName").val()));
    data.append("projectId", projectId)

    if($("#featureName").val() == null || $.trim($("#featureName").val()) == "")  { $('#saveFeatureBtn').prop('disabled', true); }
    else 
    {
        axios.post("../Feature/target.php", data)
        .then((res) => 
        {
            if(res.data)
            {
                $("#featureName").addClass("is-invalid");
                $("#featureValidationSmall").html("Feature name not available!");
                $("#featureValidationSmall").addClass("text-danger");
                $('#saveFeatureBtn').prop('disabled', true);
            }
            else 
            {
                $("#featureName").removeClass("is-invalid");
                $("#featureValidationSmall").html("");
                $("#featureValidationSmall").removeClass("text-danger");
                $('#saveFeatureBtn').prop('disabled', false);
            }
        })
    }
}

function createFeature()
{
    var projectId = new URL(window.location.href).searchParams.get("projectId");

    var data = new FormData();
    data.append('function', "createFeature");
    data.append('featureName', $.trim($("#featureName").val()));
    data.append('projectId', projectId);

    axios.post("../Feature/target.php", data)
    .then(() => 
    {
        overHang("success", "Feature has been successfully created!");
        $("#listOfFeatures").children().remove();
        loadFeatures();
        $('#featureModal').modal('hide');
    })
}

function activateFeaturePrompt()
{
    let featureId = $("#selectedFeatureId").html();

    $("#featureModalTitle").html("Activate Feature"); 
    let featureEditDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let featureSelectLabel = $("<label>").html("Are you sure you want to activate this feature?");

    $("#featureModalBody").html("").append(featureEditDiv);
    $(featureEditDiv).append(featureSelectLabel);

    $("#featureModalFooter").html("").append($("<button>", {class : "btn btn-primary", type : "text", id : "activateFeatureBtn", onclick : "activateFeature(featureId)"}).html("Save"));

}

function activateFeature(featureId)
{
    var data = new FormData();
    data.append('function', "activateFeature");
    data.append('featureId', featureId);

    axios.post("../Feature/target.php", data)
    .then(() => 
    {
        overHang("success", "Feature has been successfully activated!");
        $("#listOfFeatures").children().remove();
        loadFeatures();
        $('#featureModal').modal('hide');
    })
}

function deactivateFeaturePrompt
{
    let featureId = $("#selectedFeatureId").html();

    $("#featureModalTitle").html("Activate Feature"); 
    let featureEditDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let featureSelectLabel = $("<label>").html("Are you sure you want to deactivate this feature?");

    $("#featureModalBody").html("").append(featureEditDiv);
    $(featureEditDiv).append(featureSelectLabel);

    $("#featureModalFooter").html("").append($("<button>", {class : "btn btn-primary", type : "text", id : "deactivateFeatureBtn", onclick : "deactivateFeature(featureId)"}).html("Save"));

}

function deactivateFeature(featureId)
{
    var data = new FormData();
    data.append('function', "deactivateFeature");
    data.append('featureId', featureId);

    axios.post("../Feature/target.php", data)
    .then(() => 
    {
        overHang("success", "Feature has been successfully deactivated!");
        $("#listOfFeatures").children().remove();
        loadFeatures();
        $('#featureModal').modal('hide');
    })
}

function createTicketPrompt(projectId)
{
    $("#projectModalHead").html("Create Ticket");

    let createTicketDiv = $("<div>", {class : "form-group"});
    $(createTicketDiv).append($("<label>", { class : "my-3"}).html("Project ID"));
    $(createTicketDiv).append($("<input>", { id : "projectId", class: "form-control", value : projectId}).prop("disabled", true));
    $(createTicketDiv).append($("<label>", { class : "my-3"}).html("Summary"));
    $(createTicketDiv).append($("<input>", { id : "summary", "class": "form-control", onkeyup : "ticketValidation()"}));
    $(createTicketDiv).append($("<input>", { id : "reporterKey", value : userId, type : "hidden"}));
    $(createTicketDiv).append($("<input>", { id : "function", value : "createTicket", type : "hidden"}));
    let ticketValidationSmall = $("<small>", {id : "ticketValidationSmall"});
    
    $("#projectModalBody").html("").append(createTicketDiv);
    $("#projectModalBody").append(ticketValidationSmall);
    $("#projectModalFooter").html("").append($("<button>", { id : "saveTicketBtn", class : "btn btn-primary", type : "submit" , onclick : "createTicket()"}).html("Save"));
    $('#saveTicketBtn').prop('disabled', true);
}

function ticketValidation()
{
    var data = new FormData();
    data.append("function", "checkTicketExistance");
    data.append("ticketName", $.trim($("#summary").val()));
    data.append("featureId", $("#selectedFeatureId").html());
    
    if($("#summary").val().length >= 20)
    {
        $("#ticketValidationSmall").html("Project name too large!");
        $("#ticketValidationSmall").addClass("text-danger");
        $('#saveTicketBtn').prop('disabled', true);
        return;
    }

    if($("#summary").val() == null || $.trim($("#summary").val()) == "")  { $('#saveTicketBtn').prop('disabled', true); }
    else 
    {   
        axios.post("../Ticket/target.php", data)
        .then((res) => 
        {
            if(res.data)
            {
                $("#summary").addClass("is-invalid");
                $("#ticketValidationSmall").html("Ticket name not available!");
                $("#ticketValidationSmall").addClass("text-danger");
                $('#saveTicketBtn').prop('disabled', true);
            }
            else 
            {
                $("#summary").removeClass("is-invalid");
                $("#ticketValidationSmall").html("");
                $("#ticketValidationSmall").removeClass("text-danger");
                $('#saveTicketBtn').prop('disabled', false);
            }
        })
    }
}

function createTicket()
{
    var data = new FormData();
    data.append('function', "createTicket");
    data.append('projectId', $("#selectedFeatureId").html());
    data.append('reporterKey',$("#reporterKey").val());
    data.append('summary', $("#summary").val());

    axios.post("../Project/target.php", data)
    .then(() =>
    {
        loadTicketsWithProgress(document.getElementById("selectedFeatureId").innerHTML);
        overHang("success", "Ticket has been successfully created!");
        $('#projectModal').modal('hide');
    })
}

function loadTicketsWithProgress(progress) 
{
    let selectedFeatureId = $("#selectedFeatureId").html();
    if (selectedFeatureId == 0) return false;

    $("#ticketBtnDiv").html("");
    if (userLevel >= 2) $("#ticketBtnDiv").append($("<button>", { "data-toggle" : "modal" , "data-target" : "#projectModal" , onclick : createTicketPrompt(selectedFeatureId)}).html("Create Ticket"));
    loadTicketsWithProgressFromServer(selectedFeatureId, progress)
    .then (response => 
    {
        if (progress == "Open")
        {
            $('#progress-tab, #complete-tab').removeClass('active');
            $("#open-tab").addClass('active');
        }

        var json = response.data;
        $("#ticketTable").find("tr:gt(0)").remove(); // Clears table

        for (i = 0; i < json.length; i++)
        {
            json[i].forename == null ? assignee = document.createTextNode("Not assigned") 
            : assignee = document.createTextNode(`${json[i].forename} ${json[i].surname}`);

            let newRow = document.getElementById("ticketTable").insertRow(-1);
            let cell1 = newRow.insertCell(0)
            let cell2 = newRow.insertCell(1)
            let cell3 = newRow.insertCell(2)
            let cell4 = newRow.insertCell(3)

            $(cell1).append(document.createTextNode(json[i].ticketId))
            $(cell2).append($("<a>", { href : `../Ticket/index.php?ticketId=${json[i].ticketId}`}).html(`${json[i].summary}`));
            $(cell3).append(document.createTextNode(json[i].progress))
            $(cell4).append(assignee)
        }
    })
}