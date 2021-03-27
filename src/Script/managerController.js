$(document).ready(() => { loadProjects(); NavbarActivater.accountActiveTab(); } );

async function loadOwnerProjects()
{
    var data = new FormData();
    data.append("function", "loadOwnerProjects");
    return await axios.post("../Manager/target.php", data)
}

async function loadManagerProjects()
{
    var data = new FormData();
    data.append("function", "loadManagerProjects");
    return await axios.post("../Manager/target.php", data) 
}

async function loadUsersOnProject(projectId)
{
    var data = new FormData();
    data.append("function", "loadUsersOnProject");
    data.append("projectId", projectId);
    return await axios.post("../Manager/target.php", data) 
}

async function removeUsersToServer(projectId)
{
    var data = new FormData();
    data.append("function", "removeUsersFromProject");
    data.append("projectId", projectId);
    return await axios.post("../Manager/target.php", data) 
}

async function saveUsersToServer(jsondata)
{
    var data = new FormData();
    data.append("function", "addUsersToProject");
    data.append("json", JSON.stringify(jsondata));
    return await axios.post("../Manager/target.php", data) 
}

async function loadProjects() 
{
    var ownerProjects = await loadOwnerProjects();
    var managerProjects = await loadManagerProjects();
    $("#projectSize").html(ownerProjects.data.length + managerProjects.data.length);
    $("#projectUl").html("");

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

function addUser(userId, forename, surname, username, managerAccess)
{
    var currentRole = managerAccess == "1" ? "Manager" : "Developer"
    var userUl = $(".list-group.list-group-flush.user-list");
    var user = $("<li>", { "value" : userId, "class" : "list-group-item users"});
    var userInfo = $("<div>", {"class" : "user-info"});
    var userSpan = $("<span>").html(`${forename} ${surname} (${username})`);
    var btnGroup = $("<div>", { "class" : "btn-group"});
    var roleBtn = $("<button>", { type:"button", class : "btn btn-light dropdown-toggle", "data-toggle" : "dropdown" }).append(currentRole);
    var dropDownMenu = $("<div>", {"class" : "dropdown-menu roles"});
    var managerRole = $("<a>", {"class" : "dropdown-item role"}).html("Manager");
    var developerRole = $("<a>", {"class" : "dropdown-item role"}).html("Developer");
    var xSign = $("<a>", {"class" : "fas fa-times"});

    $(dropDownMenu).append(managerRole);
    $(dropDownMenu).append(developerRole);
    
    $(btnGroup).append(roleBtn);
    $(btnGroup).append(dropDownMenu);

    $(userInfo).append(userSpan);
    $(userInfo).append(btnGroup);
    
    $(user).append(userInfo);
    $(user).append(xSign);
    $(userUl).append(user);
}

async function rolePrompt(projectId)
{
    var json = await loadUsersOnProject(projectId);
    $(".list-group.list-group-flush.user-list").html("");
    $(".autocom-box").html("");
    
    for (i = 0; i < json.data.length; i++)
    {
        addUser(json.data[i].userId, json.data[i].forename, json.data[i].surname, json.data[i].username, json.data[i].managerAccess)
    }

    var saveBtn = $("<button>", { type:"button", class : "btn btn-success", "onclick" : `saveUsers(${projectId})`}).html("Save changes");
    var closeBtn = $("<button>", { type:"button", class : "btn btn-secondary", "data-dismiss" : "modal" }).html("Close");
    $("#managerModalFooter").html("").append(saveBtn).append(closeBtn);
}

// Dynamically change the role in the Modal
$(document).click(function (e) {
    $(e.target).attr('class') == "dropdown-item role" ? $(e.target).parent().siblings("button").html(e.target.outerText) : null;
});

// Search Box autofill
$(".search-input").keyup(e => {
    let input = e.target.value;
    var usersArray = []; users.forEach((user => usersArray.push(`${user.userId},${user.forename},${user.surname},${user.username}`)));
    if (input)
    {
        let results = []; results = usersArray.filter(data => data.toLowerCase().indexOf(input.toLowerCase()) !== -1);
        $(".autocom-box").html("");
        results.map(data => {
            let usersAlreadySelected = [];
            document.querySelectorAll(".list-group-item.users").forEach(list => usersAlreadySelected.push(`${list.value}`));
            var elements = data.split(",");
            if (!usersAlreadySelected.includes(elements[0]))
            $(".autocom-box").append($("<li>", {value : `${elements[0]},${elements[1]},${elements[2]},${elements[3]}`}).html(`${elements[1]} ${elements[2]}`));
        })
    }
    else { $(".autocom-box").html("") }
})

// When selecting the user
$(".autocom-box").on("click", "li", function() {
    var userSelected = $(this).attr("value").split(",");
    addUser(userSelected[0], userSelected[1], userSelected[2], userSelected[3], 0);
    $(this).remove();
});

// Remove user from list 
$(document).click(function (e) {
    $(e.target).attr('class') == "fas fa-times" ? $(e.target).closest("li").remove() : null;
});

async function saveUsers(projectId)
{
    var userIds = []; var accessList = []; var jsondata = []
    document.querySelectorAll(".list-group-item.users").forEach(list => userIds.push(`${list.value}`));
    document.querySelectorAll(".btn.btn-light.dropdown-toggle").forEach(list => accessList.push(`${list.innerHTML}`));

    for (i = 0; i < userIds.length; i++)
    {
        jsondata.push(
        {
            "userId": userIds[i],
            "projectId": projectId,
            "allowAccess": 1,
            "managerAccess": accessList[i] == "Manager" ? 1 : 0 
        });
    }

    if(userIds.length == 0)
    {
        await removeUsersToServer(projectId);
        $("#managerModal").modal('hide');
        overHang("success", "Removed Access to All!");
    }
    else 
    {
        await removeUsersToServer(projectId);
        await saveUsersToServer(jsondata);
        $("#managerModal").modal('hide');
        overHang("success", "Project Access updated!");
    }
}

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
    let projectValidationSmall = $("<small>", { id: "projectValidationSmall" });
    $(statusSelect).append($("<option>").val("0").text("").prop({ "selected": true, "disabled": true }));
    $(statusSelect).append($("<option>").val("Back-log").text("Back-log"));
    $(statusSelect).append($("<option>").val("Development").text("Development"));
    $(statusSelect).append($("<option>").val("QA").text("QA"));
    $(statusSelect).append($("<option>").val("Releasing").text("Releasing"));
    $(statusSelect).append($("<option>").val("Released").text("Released"));

    $("#globalModalBody").append(statusDiv);
    $("#globalModalBody").append(projectValidationSmall);
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

    if($("#projectName").val().length >= 20)
    {
        $("#projectValidationSmall").html("Project name too large!");
        $("#projectValidationSmall").addClass("text-danger");
        $('#saveProjectBtn').prop('disabled', true);
        return;
    }

    if ($("#projectStatus").val() == null || $.trim($("#projectName").val()) == "") { $('#saveProjectBtn').prop('disabled', true); }
    else 
    {
        axios.post("../Project/target.php", data)
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

    axios.post("../Project/target.php", data)
        .then(() => 
        {
            $('#globalModal').modal('hide');
            loadOwnerProjects();
        })
}