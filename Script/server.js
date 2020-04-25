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