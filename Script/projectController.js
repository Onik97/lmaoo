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

            summaryLink = document.createElement("a"); 
            summaryLink.setAttribute('href', "../Ticket/Index.php?ticketId=" + json[i].ticketId);
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
    document.getElementById("projectModalHead").innerHTML = "Create Project"

    document.getElementById("projectModalBody").innerHTML = 
    `
    <div class="form-group modal-content-1">    
        <label for="projectName">Project Name:</label><br>
        <input class="form-control" type="text" id="projectName" onkeyup="projectConfirmation()" required> <br>
    </div>
    <div class="modal-content-2 form-group">
        <label for="projectStatus">Status:</label><br>
        <select id ="projectStatus" class="form-control" required name="projectStatus">
            <option value="0" selected disabled ></option>
            <option value="Back-log">Back-Log</option>
            <option value="Development">Development</option>
            <option value="QA">QA</option>
            <option value="Releasing">Releasing</option>
            <option value="Released">Released</option>
        </select>
    </div>
        <input type="hidden" name="function" value="createProject">
    `; 

    document.getElementById("projectModalFooter").innerHTML = `
    <button id="saveProjectBtn" class="btn btn-primary" onclick="createProject()" disabled >Save</button>
    `;
}

function projectConfirmation() 
{
    document.getElementById("projectName").value.trim() == "" || document.getElementById("projectStatus").value == 0
    ? document.getElementById("saveProjectBtn").disabled = true : document.getElementById("saveProjectBtn").disabled = false;
}

function createProject()
{
    var projectStatus = document.getElementById("projectStatus").options[document.getElementById("projectStatus").selectedIndex].text;

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

    document.getElementById("projectModalBody").innerHTML = 
    `
    <div class="form-group">
        <label for="projectId" class="modal-content-1">Project ID</label> 
        <input type="text" id="projectId" class="form-control" value="${projectId}" disabled> 
        <label for="summary" class="modal-content-2">Summary</label> 
        <input type="text" id="summary" class="form-control" onkeyup="ticketConfirmation()" required>
        <input type="hidden" id="reporterKey" value="${userId}">
        <input type="hidden" id="function" value="createTicket">
    </div>
    `;

    document.getElementById("projectModalFooter").innerHTML = 
    `
    <button id="saveTicketBtn" class="btn btn-primary" type=submit onclick="createTicket()" disabled >Save</button>
    `;
}

function ticketConfirmation() 
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