function checkUsernameFromServer(formdata)
{
    const response = axios(
    {
        method: 'post',
        url: '../User/userController.php',
        data: formdata,
        headers: {'Content-Type': 'multipart/form-data' }
    })

    return response;
}

function loadProjectsFromServer(formdata)
{
    const response = axios(
    {
        method: 'post',
        url: '../Project/projectController.php',
        data: formdata,
        headers: {'Content-Type': 'multipart/form-data' }
    })

    return response;
}

function loadTicketsFromServer(id)
{
    const response = axios(
        {
            method: 'get',
            url: '../Project/projectController.php?projectId='+id,
            headers: {'Content-Type': 'multipart/form-data' }
        })
    
        return response;
}

function loadUsersFromServer()
{
    var formData = new FormData();
    formData.append('function', "loadAllUsers");

    const response = axios(
        {
            method: 'post',
            data: formData,
            url: '../User/userController.php',
            headers: {'Content-Type': 'multipart/form-data' }
        })
    
        return response;
}

function loadPeopleFromServer(ticketId)
{
    var data = new FormData();
    data.append('function', "loadPeople");
    data.append('ticketId', ticketId);

    const response = axios(
        {
            method: 'post',
            data: data,
            url: '../Ticket/ticketController.php',
            headers: {'Content-Type': 'multipart/form-data' }
        })
    
        return response;
}