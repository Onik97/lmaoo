// This class is used to get a response from the server, this will help tidy up code

function checkUsernameFromServer(formdata)
{
    return response = axios(
    {
        method: 'post',
        url: '../User/userController.php',
        data: formdata,
        headers: {'Content-Type': 'multipart/form-data' }
    })
}

function loadProjectsFromServer()
{
    var data = new FormData();
    data.append('function', "loadProjects");

    return response = axios(
    {
        method: 'post',
        url: '../Project/projectController.php',
        data: data,
        headers: {'Content-Type': 'multipart/form-data' }
    })
}

function loadTicketsFromServer(id)
{
    return response = axios(
    {
        method: 'get',
        url: '../Project/projectController.php?projectId='+id,
        headers: {'Content-Type': 'multipart/form-data' }
    })
}

function loadTicketsWithProgressFromServer(id, progress)
{
    return response = axios(
    {
        method: 'get',
        url: `../Project/projectController.php?projectId=${id}&progress=${progress}`,
        headers: {'Content-Type': 'multipart/form-data' }
    })
}

function loadAssigneeFromServer(ticketId)
{
    var formData = new FormData();
    formData.append('function', "loadAssignee");
    formData.append('ticketId', ticketId);

    return response = axios(
    {
        method: 'post',
        data: formData,
        url: '../Ticket/ticketController.php',
        headers: {'Content-Type': 'multipart/form-data' }
    })

}

function loadReporterFromServer(ticketId)
{
    var data = new FormData();
    data.append('function', "loadReporter");
    data.append('ticketId', ticketId);

    return response = axios(
    {
        method: 'post',
        data: data,
        url: '../Ticket/ticketController.php',
        headers: {'Content-Type': 'multipart/form-data' }
    })
}

function getActiveUsersFromServer()
{
    var data = new FormData();
    data.append('function', "getActiveUsers");

    return response = axios(
    {
        method: 'post',
        data: data,
        url: '../User/userController.php',
        headers: {'Content-Type': 'multipart/form-data' }
    })
}

function loadCommentsFromServer(ticketId)
{
    var data = new FormData();
    data.append('function', "loadComments");
    data.append('ticketId', ticketId);

    return response = axios(
    {
        method: 'post',
        data: data,
        url: '../Ticket/ticketController.php',
        headers: {'Content-Type': 'multipart/form-data' }
    })
}

function loadDatesFromServer(ticketId)
{
    var data = new FormData();
    data.append('function', "loadDates");
    data.append('ticketId', ticketId);

    return response = axios(
    {
        method: 'post',
        data: data,
        url: '../Ticket/ticketController.php',
        headers: {'Content-Type': 'multipart/form-data' }
    })
}

function updateTicketTime(ticketId)
{
    var data = new FormData();
    data.append('function', "updateTicketTime");
    data.append('ticketId', ticketId);

    return response = axios(
    {
        method: 'post',
        data: data,
        url: '../Ticket/ticketController.php',
        headers: {'Content-Type': 'multipart/form-data' }
    })
}