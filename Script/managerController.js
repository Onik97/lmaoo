$(document).ready(() => { loadProjects(); } );

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

async function loadUsersOnProject(projectId)
{
    var data = new FormData();
    data.append("function", "loadUsersOnProject");
    data.append("projectId", projectId);
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
        var roleBtn = $("<button>", { type:"button", class : "btn btn-warning", "data-toggle" : "modal", "data-target" : "#managerModal", "onclick" : `rolePrompt(${json.projectId})`}).append("Roles");
        
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
        var role = $("<div>", {"class" : "manager-role"}).append("Manager");
        var roleBtn = $("<button>", { type:"button", class : "btn btn-warning", "data-toggle" : "modal", "data-target" : "#managerModal", "onclick" : `rolePrompt(${json.projectId})` }).append("Roles");
        
        $(projectInfo).append(json.name);
        $(projectInfo).append(projectStatus);
        $(projectInfo).append(role);
        $(projectInfo).append(roleBtn);
        $(project).append(projectInfo);
        $("#projectUl").append(project);
    }
}

async function rolePrompt(projectId)
{
    var json = await loadUsersOnProject(projectId);
    // $(".list-group.list-group-flush.user-list").html(""); // Leaving this comment for now to allow Tufan to use Static Data
    
    for (i = 0; i < json.data.length; i++)
    {
        var currentRole = (json.data[i].managerAccess == "1") ? "Manager" : "Developer"
    
        var userUl = $(".list-group.list-group-flush.user-list");
        var user = $("<li>", {"class" : "list-group-item users"});
        var userInfo = $("<div>", {"class" : "user-info"});
        var userSpan = $("<span>", {"id" : json.data[i].userId }).html(`${json.data[i].forename} ${json.data[i].surname} (${json.data[i].username})`);
        var btnGroup = $("<div>", { "class" : "btn-group"});
        var roleBtn = $("<button>", { type:"button", class : "btn btn-light dropdown-toggle", "data-toggle" : "dropdown" }).append(currentRole);
        var dropDownMenu = $("<div>", {"class" : "dropdown-menu"});
        var managerRole = $("<a>", {"class" : "dropdown-item"}).html("Manager");
        var developerRole = $("<a>", {"class" : "dropdown-item"}).html("Developer");

        $(dropDownMenu).append(managerRole);
        $(dropDownMenu).append(developerRole);
        
        $(btnGroup).append(roleBtn);
        $(btnGroup).append(dropDownMenu);

        $(userInfo).append(userSpan);
        $(userInfo).append(btnGroup);
        
        $(user).append(userInfo);
        $(userUl).append(user);
    }
    
    // Dynamically change the role in the Modal
    $(".dropdown-menu > a").click(function(e) { 
        $('.user-info').on('hidden.bs.dropdown', function() { $(this).find("button").html(e.target.outerText); });
    });
}

// Search Box autofill
$(".search-input").keyup(e => {
    let input = e.target.value;
    var usersArray = []; users.forEach((json => usersArray.push(`${json.userId},${json.forename},${json.surname}`)));
    if (input) 
    {
        let results = []; results = usersArray.filter(data => {  return data.toLowerCase().indexOf(input.toLowerCase()) !== -1; });
        $(".autocom-box").html("");
        results.map(data => { var users = data.split(",");
            $(".autocom-box").append($("<li>", {id : `${users[0]}`}).html(`${users[1]} ${users[2]}`));
        })
    }
    else { $(".autocom-box").html("") }
})

$(".autocom-box").on("click", "li", function() {
    $(this).remove(); // Removing for now, TODO: Add Users in the UL List 
});

function createProjectPrompt()
{
    $("#globalModallHead").html("Create Project");

    let projectNameDiv = $("<div>", { "class": "form-group modal-content-1" });
    let projectNameLabel = $("<label>").html("Project Name:");
    let projectNameInput = $("<input>", { class: "form-control", type: "text", id: "projectName", onkeyup: "projectValidation()" });
    $("#globalModalBody").html("").append(projectNameDiv);
    $(projectNameDiv).append(projectNameLabel);
    $(projectNameDiv).append(projectNameInput);

    let statusDiv = $("<div>", { "class": "form-group modal-content-2" });
    let statusLabel = $("<label>").html("Status:");
    let statusSelect = $("<select>", { id: "projectStatus", "class": "form-control", onchange: "projectValidation()" }).prop("required", true);
    let ticketValidationSmall = $("<small>", { id: "projectValidationSmall" });
    $(statusSelect).append($("<option>").val("0").text("").prop({ "selected": true, "disabled": true }));
    $(statusSelect).append($("<option>").val("Back-log").text("Back-log"));
    $(statusSelect).append($("<option>").val("Development").text("Development"));
    $(statusSelect).append($("<option>").val("QA").text("QA"));
    $(statusSelect).append($("<option>").val("Releasing").text("Releasing"));
    $(statusSelect).append($("<option>").val("Released").text("Released"));

    $("#globalModalBody").append(statusDiv);
    $("#globalModalBody").append(ticketValidationSmall);
    $(statusDiv).append(statusLabel);
    $(statusDiv).append(statusSelect);

    $("#globalModalFooter").html("").append($("<button>", { class: "btn btn-primary", type: "text", id: "saveProjectBtn", onclick: "createProject()" }).html("Save"));
    $('#saveProjectBtn').prop('disabled', true);
}

function projectValidation() 
{
    var data = new FormData();
    data.append("function", "checkProjectExistance");
    data.append("name", $.trim($("#projectName").val()));

    if ($("#projectStatus").val() == null || $.trim($("#projectName").val()) == "") { $('#saveProjectBtn').prop('disabled', true); }
    else 
    {
        axios.post("../Project/projectController.php", data)
            .then((res) => 
            {
                if (res.data)
                {
                    $("#projectName").addClass("is-invalid");
                    $("#projectValidationSmall").html("Project name not available, must already exist!");
                    $("#projectValidationSmall").addClass("text-danger");
                    $('#saveProjectBtn').prop('disabled', true);
                }
                else 
                {
                    $("#projectName").removeClass("is-invalid");
                    $("#projectValidationSmall").html("");
                    $("#projectValidationSmall").removeClass("text-danger");
                    $('#saveProjectBtn').prop('disabled', false);
                }
            })
    }
}

function createProject()
{
    let projectStatus = document.getElementById("projectStatus").options[document.getElementById("projectStatus").selectedIndex].text;

    var data = new FormData();
    data.append('function', "createProject");
    data.append('projectName', document.getElementById("projectName").value);
    data.append('projectStatus', projectStatus);

    axios.post("../Project/projectController.php", data)
        .then(() => 
        {
            $('#globalModal').modal('hide');
            loadOwnerProjects();
        })
}