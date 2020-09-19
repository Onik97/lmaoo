$(document).ready(function() 
{
  loadProjects();
}); 

function loadProjects()
{
    loadProjectsFromServer()
    .then(response =>
    {

        if (userLevel >= 3) $("#listOfProjects").append($("<li>", { id : "createProjectBtn" , "data-toggle" : "modal" , "data-target" : "#projectModal" , onclick : "createProjectPrompt()"}).html(" + Create Project"));
        $("#listOfProjects").find("li:gt(0)").remove();

        var json = response.data;
        for (i = 0; i < json.length; i++)
        {
            $("#listOfProjects").append($("<li>", { value : json[i].projectId , onclick : "getProjectName(this.innerHTML, this.value); loadTicketsWithProgress();"}).html(json[i].name));
        }
    })
}

function getProjectName(name, id)
{
    $("#ticketMessage").html("Tickets for " + name);
    $("#selectedProjectId").html(id);
}

function createProjectPrompt()
{
    $("#projectModalHead").html("Create Project");

    let projectNameDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let projectNameLabel = $("<label>").html("Project Name:");
    let projectNameInput = $("<input>", {class : "form-control", type : "text", id : "projectName", onkeyup : "projectConfirmation()"});
    $("#projectModalBody").html("").append(projectNameDiv);
    $(projectNameDiv).append(projectNameLabel);
    $(projectNameDiv).append(projectNameInput);

    let statusDiv = $("<div>", {"class" : "form-group modal-content-2"});
    let statusLabel = $("<label>").html("Status:");
    let statusSelect = $("<select>", { id : "projectStatus", "class" : "form-control"}).prop("required", true);
    $(statusSelect).append($("<option>").val("0").text("").prop({"selected" : true, "disabled" : true}));
    $(statusSelect).append($("<option>").val("Back-log").text("Back-log"));
    $(statusSelect).append($("<option>").val("Development").text("Development"));
    $(statusSelect).append($("<option>").val("QA").text("QA"));
    $(statusSelect).append($("<option>").val("Releasing").text("Releasing"));
    $(statusSelect).append($("<option>").val("Released").text("Released"));

    $("#projectModalBody").append(statusDiv);
    $(statusDiv).append(statusLabel);
    $(statusDiv).append(statusSelect);

    $("#projectModalFooter").html("").append($("<button>", {class : "btn btn-primary", type : "text", id : "saveProjectBtn", onclick : "createProject()"}).html("Save"));
}

function projectConfirmation() 
{
    document.getElementById("projectName").value.trim() == "" || document.getElementById("projectStatus").value == 0
    ? document.getElementById("saveProjectBtn").disabled = true : document.getElementById("saveProjectBtn").disabled = false;
}

function createProject()
{
    let projectStatus = document.getElementById("projectStatus").options[document.getElementById("projectStatus").selectedIndex].text;

    var data = new FormData();
    data.append('function', "createProject");
    data.append('projectName', document.getElementById("projectName").value);
    data.append('projectStatus', projectStatus);

    axios.post("../Project/projectController.php", data)
    .then(() => 
    {
        overHang("success", "Project has been successfully created!");
        loadProjects();
        $('#projectModal').modal('hide');
    })
}

function createTicketPrompt(projectId)
{
    $("#projectModalHead").html("Create Ticket");

    let createTicketDiv = $("<div>", {class : "form-group"});
    $(createTicketDiv).append($("<label>", { class : "modal-content-1"}).html("Project ID"));
    $(createTicketDiv).append($("<input>", { id : "projectId", class: "form-control", value : projectId}).prop("disabled", true));
    $(createTicketDiv).append($("<label>", { class : "modal-content-2"}).html("Summary"));
    $(createTicketDiv).append($("<input>", { id : "summary", "class": "form-control", onkeyup : "ticketConfirmation()"}));
    $(createTicketDiv).append($("<input>", { id : "reporterKey", value : userId, type : "hidden"}));
    $(createTicketDiv).append($("<input>", { id : "function", value : "createTicket", type : "hidden"}));
    
    $("#projectModalBody").html("").append(createTicketDiv);
    $("#projectModalFooter").html("").append($("<button>", { id : "saveTicketBtn", class : "btn btn-primary", type : "submit" , onclick : "createTicket()"}).html("Save"));
}

function ticketConfirmation() // TODO: Onik -> Improve Ticket Confirmation -> Perhaps rename it to ticketValidation for serialisation
{
    document.getElementById("summary").value.trim() == ""
    ? document.getElementById("saveTicketBtn").disabled = true : document.getElementById("saveTicketBtn").disabled = false;
}

function createTicket()
{
    var data = new FormData();
    data.append('function', "createTicket");
    data.append('projectId', document.getElementById("selectedProjectId").innerHTML);
    data.append('reporterKey', document.getElementById("reporterKey").value);
    data.append('summary', document.getElementById("summary").value);

    axios.post("../Project/projectController.php", data)
    .then(() =>
    {
        loadTicketsWithProgress(document.getElementById("selectedProjectId").innerHTML);
        overHang("success", "Ticket has been successfully created!");
        $('#projectModal').modal('hide');
    })
}

function loadTicketsWithProgress(progress) 
{
    let selectedProjectId = document.getElementById("selectedProjectId").innerHTML;
    if (selectedProjectId == 0) return false;

    if (userLevel >= 2) document.getElementById("ticketBtnDiv").innerHTML = 
        `<button data-toggle="modal" data-target="#projectModal" onclick="createTicketPrompt(${selectedProjectId})">Create Ticket</button>`;

    loadTicketsWithProgressFromServer(selectedProjectId, progress)
    .then (response => 
    {
        var json = response.data;
        $("#ticketTable").find("tr:gt(0)").remove(); // Clears table

        for (i = 0; i < json.length; i++)
        {
            let ticketId = document.createTextNode(json[i].ticketId);
            let summary = document.createTextNode(json[i].summary);
            let progress = document.createTextNode(json[i].progress);
            let assignee = document.createTextNode(`${json[i].forename} ${json[i].surname}`);
            if (json[i].forename == null) assignee = document.createTextNode("Not assigned");

            summaryLink = document.createElement("a"); 
            summaryLink.setAttribute('href', `../Ticket/index.php?ticketId=${json[i].ticketId}`);
            summaryLink.appendChild(summary);
            
            let newRow = document.getElementById("ticketTable").insertRow(-1);

            newRow.insertCell(0).appendChild(ticketId);
            newRow.insertCell(1).appendChild(summaryLink);
            newRow.insertCell(2).appendChild(progress);
            newRow.insertCell(3).appendChild(assignee);
        }
    })
}