$(document).ready(function() 
{
    loadOwnProjects();
    loadTicketDeadlines();
});

function loadOwnProjects()
{
    if (typeof userId == 'undefined') return;

    var data = new FormData();
    data.append("function", "loadOwnProjects");

    axios.post("../Home/target.php", data)
    .then(response =>
    {
        let json = response.data;

        let ProjectList = $("#homeProjects");
        $(ProjectList).find("li:gt(0)").remove();

        for (i = 0; i < json.length; i++)
        {
        $(ProjectList).append($("<li>", {class : "list-inline-item homeTable"}).html(json[i].projectId));
        $(ProjectList).append($("<li>", {class : "list-inline-item homeTable"}).html(json[i].name));
        $(ProjectList).append($("<li>", {class : "list-inline-item homeTable"}).html(json[i].status));
        $(ProjectList).append($("<hr>", {class : "small-hr"}));
        }
    })
}

function loadTicketDeadlines()
{
    if (typeof userId == 'undefined') return;

    var data = new FormData();
    data.append("function", "loadTicketsWithDeadline");
    data.append("assignee_key", userId);

    axios.post("../Home/target.php", data)
    .then(response =>
    {
        let json = response.data;

        let ticketDeadline = $("#homeTickets");
        $(ticketDeadline).find("li:gt(0)").remove();

        for (i = 0; i < json.length; i++)
        {
        $(ticketDeadline).append($("<li>", {class : "list-inline-item ticketTable"}).html(json[i].ticketId));
        $(ticketDeadline).append($("<li>", {class : "list-inline-item ticketTable"}).html(json[i].summary));
        $(ticketDeadline).append($("<li>", {class : "list-inline-item ticketTable"}).html(json[i].progress));
        $(ticketDeadline).append($("<li>", {class : "list-inline-item ticketTable"}).html(json[i].deadline));
        $(ticketDeadline).append($("<hr>", {class : "small-hr"}));
        }
    })
}