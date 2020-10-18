let navBarActive = document.getElementById("navBarActive").innerHTML;

(navBarActive == "homePage") ? (document.getElementById("homeNav").classList.add("active"))
: (navBarActive == "projectPage" || navBarActive == "ticketPage") ? (document.getElementById("projectNav").classList.add("active"))
: (navBarActive == "registerPage" || navBarActive == "loginPage" || navBarActive == "adminPage") ? (document.getElementById("accountNav").classList.add("active"))
: null;

function createProjectPrompt()
{
    $("#globalModallHead").html("Create Project");

    let projectNameDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let projectNameLabel = $("<label>").html("Project Name:");
    let projectNameInput = $("<input>", {class : "form-control", type : "text", id : "projectName", onkeyup : "projectConfirmation()"});
    $("#globalModalBody").html("").append(projectNameDiv);
    $(projectNameDiv).append(projectNameLabel);
    $(projectNameDiv).append(projectNameInput);

    let statusDiv = $("<div>", {"class" : "form-group modal-content-2"});
    let statusLabel = $("<label>").html("Status:");
    let statusSelect = $("<select>", { id : "projectStatus", "class" : "form-control"}).prop("required", true);
    $(statusSelect).append($("<option>").val("0").text("").prop({"selected" : true, "disabled" : true}));
    $(statusSelect).append($("<option>").val("Back-log").text("Back-log"));
    $(statusSelect).append($("<option>").val("Development").text("Development"));
    $(statusSelect).append($("<option>").val("QA").text("QA"));
    $(statusSelect).append($("<option>").val("Releasing").text("Releasing"));
    $(statusSelect).append($("<option>").val("Released").text("Released"));

    $("#globalModalBody").append(statusDiv);
    $(statusDiv).append(statusLabel);
    $(statusDiv).append(statusSelect);

    $("#globalModalFooter").html("").append($("<button>", {class : "btn btn-primary", type : "text", id : "saveProjectBtn", onclick : "createProject()"}).html("Save"));
}

function projectValidation() 
{
    
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
        location.reload(); // Refreshes Page as Projects is loaded from PHP, not Javascript
    })
}