
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
                `<button>Create Ticket</button>
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

function createTicketPrompt()
{
    document.getElementById("projectModalBody").innerHTML = `
        <form action="projectController.php" method="POST">
            Project Name<br>
            <input type="text" name="projectName">
            <br>
            Status:<br>
            <select id ="projectStatus" name="projectStatus">
                <option value="" selected disabled></option>
                <option value="Back-log">Back-Log</option>
                <option value="Developement">Development</option>
                <option value="QA">QA</option>
                <option value="Releasing">Releasing</option>
                <option value="Released">Released</option>
            </select>
            <br><br>
            <input type="hidden" name="function" value="createTicket">
            <input class="btn btn-primary" type="submit" value="Create Ticket">
        </form>
    `;

    document.getElementById("projectModalFooter").innerHTML = `
    `;

}
