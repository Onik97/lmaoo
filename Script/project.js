function getProjectId(id)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "projectController.php?projectId="+id, true)
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var ticketJSON = JSON.parse(this.responseText);
                document.getElementById("ticketDiv").innerHTML = 
                `<h1>Tickets</h1>
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