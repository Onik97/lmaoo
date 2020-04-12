$(document).ready(function() 
{
  loadProjects();
}); 

function loadProjects()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "projectController.php", true)

    var data = new FormData();
    data.append('function', "loadTickets");

    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var ticketJSON = JSON.parse(this.responseText);
            if (userLevel == 2) 
            {
                document.getElementById("projectDiv").innerHTML = `
                <button data-toggle="modal" data-target="#projectModal" role="button" onclick="createProjectPrompt()">Create Project</button>`
            }
            document.getElementById("projectDiv").innerHTML += `
            <h1>Projects</h1>
            ${ticketJSON.map(function(ticket)
            {
            return `
            <button class="btn btn-primary" onclick="getProjectName(this.innerHTML); getTicketWithProjectId(this.value)" value="${ticket.projectId}">${ticket.name}</button> <br>   
            `;
            }).join('')}
            `;
        }
    }
    xmlhttp.send(data);
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
            if (userLevel == 2)
            {
                document.getElementById("ticketBtnDiv").innerHTML = 
                `<button data-toggle="modal" data-target="#projectModal" onclick="createTicketPrompt(${id})">Create Ticket</button>`;
            }
            document.getElementById("ticketDiv").innerHTML = 
            `<table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Ticket ID</th>
                <th scope="col">Task</th>
                <th scope="col">Progress</th>
                <th scope="col">View</th>
                </tr>
            </thead>
            ${ticketJSON.map(function(ticket)
                {
                    return `
                    <tr>
                    <th scope="row">${ticket.ticketId}</th>
                    <td>${ticket.task}</td>
                    <td>Not included in the database</td>
                    <td><a class="btn btn-info" href="../Ticket/index.php?ticketId=${ticket.ticketId}">View</a></td>
                    </tr>
                    `;
                }).join('')}
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
                <option value="" selected disabled ></option>
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
    <button id="saveProjectPrompt" class="btn btn-primary" onclick="createProject()" disabled >Save</button>
    `;
}

function projectConfirmation() {
    if(document.getElementById("projectName").value==="") { 
        document.getElementById("saveProjectPrompt").disabled = true;
    } else{ 
        document.getElementById("saveProjectPrompt").disabled = false;
        
       }
   }
 
   window.onload=function()
   {
       document.getElementById("projectStatus").onchange=function()
       {
           if(this.options[this.selectedIndex].value==="")
           {
               document.getElementById("saveProjectPrompt").disabled=true;
           }
           else
           {
               document.getElementById("saveProjectPrompt").disabled=false;
           }
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
    <input type="text" id="task" required> <br>
    <label>Progress</label> <br>
    <input type="text" id="progress" required> <br>
    <input type="hidden" id="reporterKey" value="${userId}"> 
    <input type="hidden" id="function" value="createTicket"> <br>
    `;

    document.getElementById("projectModalFooter").innerHTML = `
    <button class="btn btn-primary" type=submit onclick="createTicket()">Save</button>
    `;
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