$(document).ready(() => loadSummary());

function loadSummary()
{
    var ticketId = new URL(window.location.href).searchParams.get("ticketId");
    var data = new FormData();
    data.append('function', "loadSummary");
    data.append('ticketId', ticketId);

    axios.post('../Ticket/target.php', data).then((res) => $("#ticketSummaryHeader").html(res.data));
}