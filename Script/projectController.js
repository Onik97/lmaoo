$(document).ready(function() 
{
  loadProjects();
}); 

function loadProjects()
{
    loadProjectsFromServer()
    .then(response =>
    {
        document.getElementById("listOfProjects").innerHTML = "";
        var json = response.data;
        for (i = 0; i < json.length; i++)
        {
            document.getElementById("listOfProjects").innerHTML += 
            `<li onclick="getProjectName(this.innerHTML); getTicketWithProjectId(this.value)" value="${json[i].projectId}">${json[i].name}</li>`
        }

        if (userLevel >= 3) document.getElementById("listOfProjects").innerHTML += 
            `<li id="createProjectBtn" data-toggle="modal" data-target="#projectModal" onclick="createProjectPrompt()"> + Create Project</li>`
    })
}

function getProjectName(name)
{
   document.getElementById("ticketMessage").innerHTML = "Tickets for " + name;
}

function getTicketWithProjectId(id)
{
    if (userLevel >= 2) document.getElementById("ticketBtnDiv").innerHTML = 
        `<button data-toggle="modal" data-target="#projectModal" onclick="createTicketPrompt(${id})">Create Ticket</button>`;

    loadTicketsFromServer(id)
    .then(response => 
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
            summaryLink.setAttribute('href', `../Ticket/Index.php?ticketId=${json[i].ticketId}`);
            summaryLink.appendChild(summary);
            
            let newRow = document.getElementById("ticketTable").insertRow(-1);

            newRow.insertCell(0).appendChild(ticketId);
            newRow.insertCell(1).appendChild(summaryLink);
            newRow.insertCell(2).appendChild(progress);
            newRow.insertCell(3).appendChild(assignee);
        }
    })
}

function createProjectPrompt()
{
    document.getElementById("projectModalHead").innerHTML = "Create Project";

    document.getElementById("projectModalBody").innerHTML = "";

    let projectNameDiv = $("<div>", {"class": "form-group modal-content-1"});
    let projectNameLabel = $("<label>").html("Project Name:");
    let projectNameInput = $("<input>", {"class": "form-control", type : "text", id : "projectName", onkeyup : "projectConfirmation()"});
    $("#projectModalBody").append(projectNameDiv);
    $(projectNameDiv).append(projectNameLabel);
    $(projectNameDiv).append(projectNameInput);

    let statusDiv = $("<div>", {"class": "form-group modal-content-2"});
    let statusLabel = $("<label>").html("Status:");
    let statusSelect = $("<select>", { id : "projectStatus", "class": "form-control"}).prop("required", true);
    $(statusSelect).append($("<option>").val("0").text(""));
    $(statusSelect).append($("<option>").val("Back-log").text("Back-log"));
    $(statusSelect).append($("<option>").val("Development").text("Development"));
    $(statusSelect).append($("<option>").val("QA").text("QA"));
    $(statusSelect).append($("<option>").val("Releasing").text("Releasing"));
    $(statusSelect).append($("<option>").val("Released").text("Released"));

    $("#projectModalBody").append(statusDiv);
    $(statusDiv).append(statusLabel);
    $(statusDiv).append(statusSelect);

    $("#projectModalFooter").html("").append($("<button>", {"class": "btn btn-primary", type : "text", id : "saveProjectBtn", onclick : "createProject()"}).html("Save"));
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

    let createTicketDiv = $("<div>", {"class": "form-group"});
    $(createTicketDiv).append($("<label>", {"class": "modal-content-1"}).html("Project ID"));
    $(createTicketDiv).append($("<input>", { id : "projectId", "class": "form-control", value : projectId}));
    $(createTicketDiv).append($("<label>", { "class": "modal-content-2",}).html("Summary"));
    $(createTicketDiv).append($("<input>", { id : "summary", "class": "form-control", onkeyup : "ticketConfirmation()"}));
    $(createTicketDiv).append($("<input>", { type : "hidden", id : "reporterKey", value : userId}));
    $(createTicketDiv).append($("<input>", { type : "hidden", id : "function", value : "createTicket"}));

    $("#projectModalFooter").html("").append($("<button>", { id : "saveTicketBtn", class : "btn btn-primary", type : "submit" , onclick : "createTicket()"}).html("Save"));
}

function ticketConfirmation()  // Use onchange instead of onkeyup for the drop down
{
    document.getElementById("summary").value.trim() == ""
    ? document.getElementById("saveTicketBtn").disabled = true : document.getElementById("saveTicketBtn").disabled = false;
}

function createTicket()
{
    var data = new FormData();
    data.append('function', "createTicket");
    data.append('projectId', document.getElementById("projectId").value);
    data.append('reporterKey', document.getElementById("reporterKey").value);
    data.append('summary', document.getElementById("summary").value);

    axios.post("../Project/projectController.php", data)
    .then(() =>
    {
        getTicketWithProjectId(document.getElementById("projectId").value);
        overHang("success", "Ticket has been successfully created!");
        $('#projectModal').modal('hide');
    })
}