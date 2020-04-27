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

        if (userLevel >= 2) 
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
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "projectController.php?projectId="+id, true)
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var ticketJSON = JSON.parse(this.responseText);
            if (userLevel >= 2)
            {
                document.getElementById("ticketBtnDiv").innerHTML = 
                `<button data-toggle="modal" data-target="#projectModal" onclick="createTicketPrompt(${id})">Create Ticket</button>`;
            }
            document.getElementById("ticketDiv").innerHTML = 
            `
            <table class="table">
            <div class="tableHead">
                <thead>
                    <tr>
                    <th class="col1" scope="col">Ticket ID</th>
                    <th class="col2" scope="col">Task</th>
                    <th class="col3" scope="col">Progress</th>
                    <th class="col4" scope="col">View</th>
                    </tr>
                </thead>
            </div>
            ${ticketJSON.map(function(ticket)
                {
                    return `
                    <div class="tableBody">
                    <tr>
                    <th scope="row">${ticket.ticketId}</th>
                        <td>${ticket.task}</td>
                        <td>Not included in the database</td>
                        <td><a class="btn btn-info" href="../Ticket/index.php?ticketId=${ticket.ticketId}">View</a></td>
                    </tr>
                    </div>
                    `;
                }
                ).join('')}
            `;
        }
    }
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