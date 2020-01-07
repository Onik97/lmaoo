
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
                document.getElementById("ticketDiv").innerHTML = 
                `<button data-toggle="modal" data-target="#projectModal" onclick="createTicketPrompt(${id})">Create Ticket</button>
                <table class="table">
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
        <form action="projectController.php" method="POST">
            Project Name<br>
            <input type="text" name="projectName" required> <br>
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
            <input class="btn btn-primary" type="submit" value="Create Ticket">
        </form>
    `;

    document.getElementById("projectModalFooter").innerHTML = `
    `;

}

function createTicketPrompt(projectId)
{
    document.getElementById("projectModalBody").innerHTML = `
    <form action="projectController.php" method="POST">
    <label>Project ID</label> <br>
    <input type="text" name="projectId" value="${projectId}" disabled> <br>
    <label>Reporter</label> <br>
    <input type="text" name="reporter" value="${userForename + " " + userSurname}" disabled> <br>
    <label>Task</label> <br>
    <input type="text" name="task" required> <br>
    <label>Progress</label> <br>
    <input type="text" name="progress" required> <br>
    <input type="hidden" name="reporterKey" value="${userId}"> 
    <input type="hidden" name="function" value="createTicket"> <br>
    <input class="btn btn-primary" type="submit" value="Create Ticket">
    </form>
    `;

    document.getElementById("projectModalFooter").innerHTML = `
    `;
}
