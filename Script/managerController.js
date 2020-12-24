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

async function loadProjects() 
{
    var ownerProjects = await loadOwnerProjects();
    var managerProjects = await loadManagerProjects();
    $("#projectSize").html(ownerProjects.data.length + managerProjects.data.length);
    $("#projectUl").html(""); // Empties List -> Will remove once static data has been removed

    for (i = 0; i < ownerProjects.data.length; i++)
    {
        var json = ownerProjects.data[i];
        
        var project = $("<li>", {"class" : "list-group-item"}).html("");
        var projectInfo = $("<div>", {"class" : "project-info"});
        var projectStatus = $("<div>", {"class" : "project-status"}).append(json.status);
        var role = $("<div>", {"class" : "owner-role"}).append("Owner");
        var roleBtn = $("<button>", { type:"button", class : "btn btn-warning", "data-toggle" : "modal", "data-target" : "#managerModal"}).append("Roles");
        
        $(projectInfo).append(json.name);
        $(projectInfo).append(projectStatus);
        $(projectInfo).append(role);
        $(projectInfo).append(roleBtn);
        $(project).append(projectInfo);
        $("#projectUl").append(project);
    }

    for (i = 0; i < managerProjects.data.length; i++)
    {
        var json = managerProjects.data[i];
        
        var project = $("<li>", {"class" : "list-group-item"}).html("");
        var projectInfo = $("<div>", {"class" : "project-info"});
        var projectStatus = $("<div>", {"class" : "project-status"}).append(json.status);
        var role = $("<div>", {"class" : "owner-role"}).append("Owner");
        var roleBtn = $("<button>", { type:"button", class : "btn btn-warning", "data-toggle" : "modal", "data-target" : "#managerModal"}).append("Roles");
        
        $(projectInfo).append(json.name);
        $(projectInfo).append(projectStatus);
        $(projectInfo).append(role);
        $(projectInfo).append(roleBtn);
        $(project).append(projectInfo);
        $("#projectUl").append(project);
    }
}