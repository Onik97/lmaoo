$(document).ready(function() 
{
    loadOwnProjects();
    loadTicketDeadlines();
});

function loadOwnProjects()
{
    var data = new FormData();
    data.append("function", "loadOwnProjects");
    data.append("owner", userId);

    axios.post("homeController.php", data)
    .then(response =>
    {
        let json = response.data;

        let ProjectList = $("#homeProjects");
        $(ProjectList).find("li:gt(0)").remove();

        for (i = 0; i < json.length; i++)
        {
        $(ProjectList).append($("<li>", {class : "list-inline-item"}).html(json[i].projectId));
        $(ProjectList).append($("<li>", {class : "list-inline-item"}).html(json[i].name));
        $(ProjectList).append($("<li>", {class : "list-inline-item"}).html(json[i].status));
        $(ProjectList).append($("<hr>", {class : "small-hr"}));
        }
    })
}

function loadTicketDeadlines()
{
    var data = new FormData();
    data.append("function", "loadTicketsWithDeadlines");
    data.append("assignee_key", userId);

    axios.post("homeController.php", data)
    .then(response =>
    {
        let json = response.data;

        let ticketDeadline = $("#homeTickets");
        $(ticketDeadline).find("li:gt(0)").remove();

        for (i = 0; i < json.length; i++)
        {
        $(ticketDeadline).append($("<li>", {class : "list-inline-item"}).html(json[i].ticketId));
        $(ticketDeadline).append($("<li>", {class : "list-inline-item"}).html(json[i].summary));
        $(ticketDeadline).append($("<li>", {class : "list-inline-item"}).html(json[i].progress));
        $(ticketDeadline).append($("<li>", {class : "list-inline-item"}).html(json[i].deadline));
        $(ticketDeadline).append($("<hr>", {class : "small-hr"}));
        }
    })
}