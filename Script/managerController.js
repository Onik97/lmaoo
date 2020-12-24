async function loadOwnerProjects()
{
    var data = new FormData();
    data.append("function", "loadOwnerProjects");
    return await axios.post("../Manager/managerController.php", data)
}

async function loadManagerProjects()
{
    var data = new FormData();
    data.append("function", "loadManagerProjects");
    return await axios.post("../Manager/managerController.php", data) 
}
