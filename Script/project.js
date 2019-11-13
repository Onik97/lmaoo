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
                `<h1>Ticket</h1>
                ${ticketJSON.map(function(ticket)
                    {
                        return `
                        <a class="btn btn-info" href="../Ticket/index.php?ticketId${ticket.ticketId}"> ${ticket.task} </a><br>
                        `
                    }).join('')}
                `
        }
    }
    
}