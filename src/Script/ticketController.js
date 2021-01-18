$(document).ready(() => loadSummary());

function loadSummary()
{
    var ticketId = new URL(window.location.href).searchParams.get("ticketId");
    var data = new FormData();
    data.append('function', "loadSummary");
    data.append('ticketId', ticketId);

    axios.post('../Ticket/target.php', data).then((res) => $("#ticketSummaryHeader").html(res.data));
}

function loadProgress()
{
    var ticketId = new URL(window.location.href).searchParams.get("ticketId");
    var data = new FormData();
    data.append('function', "loadProgress");
    data.append('ticketId', ticketId);

    axios.post('../Ticket/target.php', data)
    .then((res) => 
    {
        $("#ticketProgress").html(res.data);
        switch(res.data)
        {
            case "Open": $("#changeProgressBtn").html("Change progress to 'In Progress'"); break;
            case "In Progress": $("#changeProgressBtn").html("Change progress to 'In Automation'"); break;
            case "In Automation": $("#changeProgressBtn").html("Change progress to 'Complete'"); break;
            case "Complete": $("#changeProgressBtn").html("Re-open ticket"); break;
        }
    });
}

}