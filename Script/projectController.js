$(document).ready(function() 
{
  loadProjects();
}); 

function loadProjects()
{
    var data = new FormData();
    data.append('function', "loadProjects");

    loadProjectsFromServer(data)
    .then((response) =>
    {
        var json = response.data;
        for (i = 0; i < json.length; i++)
        {
            document.getElementById("listOfProjects").innerHTML += 
            `<li onclick="getProjectName(this.innerHTML); getTicketWithProjectId(this.value)" value="${json[i].projectId}">${json[i].name}</li>`
        }

        if (userLevel >= 3) 
            {
                document.getElementById("listOfProjects").innerHTML += `
                <li id="createProjectBtn" data-toggle="modal" data-target="#projectModal" onclick="createProjectPrompt()"> + Create Project</li>
                `
            };
    })
    .catch((response) => {})
}

function getProjectName(name)
{
   document.getElementById("ticketMessage").innerHTML = "Tickets for " + name;
}

function getTicketWithProjectId(id)
{
    if (userLevel >= 2)
    {
        document.getElementById("ticketBtnDiv").innerHTML = 
        `<button data-toggle="modal" data-target="#projectModal" onclick="createTicketPrompt(${id})">Create Ticket</button>`;
    }

    loadTicketsFromServer(id)
    .then((response) => 
    {
        var json = response.data;
        $("#ticketTable").find("tr:gt(0)").remove();

        for (i = 0; i < json.length; i++)
        {
            let tableRef = document.getElementById("ticketTable");
            let newRow = tableRef.insertRow(-1);

            let ticketIdCell = newRow.insertCell(0);
            let taskCell = newRow.insertCell(1);
            let progressCell = newRow.insertCell(2);
            let viewCell = newRow.insertCell(3);

            let ticketId = document.createTextNode(json[i].ticketId);
            let task = document.createTextNode(json[i].task);
            let progress = document.createTextNode("Not included in the database");
            let viewBtnContent = document.createTextNode("View");
            
            var viewBtn = document.createElement("a");
            viewBtn.classList.add("btn");
            viewBtn.classList.add("btn-info");
            viewBtn.appendChild(viewBtnContent);
            viewBtn.setAttribute('href', "../Ticket/index.php?ticketId=+"+json[i].ticketId);

            ticketIdCell.appendChild(ticketId);
            taskCell.appendChild(task);
            progressCell.appendChild(progress);
            viewCell.appendChild(viewBtn);
        }
    })
    .catch((response) => console.log(response))
}

function createProjectPrompt()
{
    document.getElementById("projectModalBody").innerHTML = `
            Project Name<br>
            <input type="text" id="projectName" onkeyup="projectConfirmation()" required> <br>
            Status:<br>
            <select id ="projectStatus" required name="projectStatus">
                <option value="0" selected disabled ></option>
                <option value="Back-log">Back-Log</option>
                <option value="Developement">Development</option>
                <option value="QA">QA</option>
                <option value="Releasing">Releasing</option>
                <option value="Released">Released</option>
            </select>
            <br><br>
            <input type="hidden" name="function" value="createProject">
    `; 

    document.getElementById("projectModalFooter").innerHTML = `
    <button id="saveProjectBtn" class="btn btn-primary" onclick="createProject()" disabled >Save</button>
    `;
}

function projectConfirmation() {
    if(document.getElementById("projectName").value.trim() == "" || document.getElementById("projectStatus").value == 0) 
    { 
        document.getElementById("saveProjectBtn").disabled = true;
    } 
    else
    { 
        document.getElementById("saveProjectBtn").disabled = false;
    }
}

function createProject()
{
    var e = document.getElementById("projectStatus");
    var projectStatus = e.options[e.selectedIndex].text;

    var data = new FormData();
    data.append('function', "createProject");
    data.append('projectName', document.getElementById("projectName").value);
    data.append('projectStatus', projectStatus);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'projectController.php', true);
    xhr.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200)
        {
            console.log(this.responseText);
            loadProjects();
            overHang("success", "Project has been successfully created!");
            $('#projectModal').modal('hide');
        }
    }
    xhr.send(data);
}

function createTicketPrompt(projectId)
{
    document.getElementById("projectModalBody").innerHTML = `
    <label>Project ID</label> <br>
    <input type="text" id="projectId" value="${projectId}" disabled> <br>
    <label>Reporter</label> <br>
    <input type="text" id="reporter" value="${userForename + " " + userSurname}" disabled> <br>
    <label>Task</label> <br>
    <input type="text" id="task" onkeyup="ticketConfirmation()" required> <br>
    <label>Progress</label> <br>
    <input type="text" id="progress" onkeyup="ticketConfirmation()" required> <br>
    <input type="hidden" id="reporterKey" value="${userId}"> 
    <input type="hidden" id="function" value="createTicket"> <br>
    `;

    document.getElementById("projectModalFooter").innerHTML = `
    <button id="saveTicketBtn" class="btn btn-primary" type=submit onclick="createTicket()" disabled >Save</button>
    `;
}

function ticketConfirmation() {
    if(document.getElementById("task").value.trim() == "" || document.getElementById("progress").value.trim() == "")
    {
        document.getElementById("saveTicketBtn").disabled = true;
    }
    else
    {
        document.getElementById("saveTicketBtn").disabled = false;
    }
}

function createTicket()
{
    var data = new FormData();
    data.append('function', "createTicket");
    data.append('projectId', document.getElementById("projectId").value);
    data.append('reporterKey', document.getElementById("reporterKey").value);
    data.append('reporter', document.getElementById("reporter").value);
    data.append('task', document.getElementById("task").value);
    //data.append('progress', document.getElementById("progress").value);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'projectController.php', true);
    xhr.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200)
        {
            console.log(this.responseText);
            getTicketWithProjectId(document.getElementById("projectId").value);
            overHang("success", "Ticket has been successfully created!");
            $('#projectModal').modal('hide');
        }
    }
    xhr.send(data);
}