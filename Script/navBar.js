let navBarActive = document.getElementById("navBarActive").innerHTML;

(navBarActive == "homePage") ? (document.getElementById("homeNav").classList.add("active"))
: (navBarActive == "projectPage" || navBarActive == "ticketPage") ? (document.getElementById("projectNav").classList.add("active"))
: (navBarActive == "registerPage" || navBarActive == "loginPage" || navBarActive == "adminPage") ? (document.getElementById("accountNav").classList.add("active"))
: null;

function searchBar()
{
    let searchbarText = $("#searchBarInput").val();

    let data = new FormData();
    data.append("function", "checkTicket");
    data.append("ticketId", searchbarText);

    axios.post("../Ticket/ticketController.php", data)
    .then(response => 
    {
        var name = response.data;
        
        if (name == true)
        {
            $("#searchBarInput").removeClass('is-invalid'); 
            window.location.href = `../Ticket/index.php?ticketId=${searchbarText}`;
        }
        else
        {
            $("#searchBarInput").addClass('is-invalid'); 
            overHang("error", "TicketID Is Incorrect!");
        }
    })
}

function loadDarkMode()
{

}

function darkModeToggle()
{
    let darkMode = $("#darkModeSwitch");

        if (darkMode.prop("checked"))
        {
            let data = new FormData();
            data.append("function", "darkModeToggle");
            data.append("darkMode", "1");
            data.append("userId", userId);

            axios.post("../User/userController.php", data);
        }
        else if (!darkMode.prop("checked"))
        {
            let data = new FormData();
            data.append("function", "darkModeToggle");
            data.append("darkMode", "0");
            data.append("userId", userId);

            axios.post("../User/userController.php", data);
        }
}

function createProjectPrompt()
{
    $("#globalModallHead").html("Create Project");

    let projectNameDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let projectNameLabel = $("<label>").html("Project Name:");
    let projectNameInput = $("<input>", {class : "form-control", type : "text", id : "projectName", onkeyup : "projectValidation()"});
    $("#globalModalBody").html("").append(projectNameDiv);
    $(projectNameDiv).append(projectNameLabel);
    $(projectNameDiv).append(projectNameInput);

    let statusDiv = $("<div>", {"class" : "form-group modal-content-2"});
    let statusLabel = $("<label>").html("Status:");
    let statusSelect = $("<select>", { id : "projectStatus", "class" : "form-control",  onchange : "projectValidation()"}).prop("required", true);
    let ticketValidationSmall = $("<small>", {id : "projectValidationSmall"});
    $(statusSelect).append($("<option>").val("0").text("").prop({"selected" : true, "disabled" : true}));
    $(statusSelect).append($("<option>").val("Back-log").text("Back-log"));
    $(statusSelect).append($("<option>").val("Development").text("Development"));
    $(statusSelect).append($("<option>").val("QA").text("QA"));
    $(statusSelect).append($("<option>").val("Releasing").text("Releasing"));
    $(statusSelect).append($("<option>").val("Released").text("Released"));

    $("#globalModalBody").append(statusDiv);
    $("#globalModalBody").append(ticketValidationSmall);
    $(statusDiv).append(statusLabel);
    $(statusDiv).append(statusSelect);

    $("#globalModalFooter").html("").append($("<button>", {class : "btn btn-primary", type : "text", id : "saveProjectBtn", onclick : "createProject()"}).html("Save"));
    $('#saveProjectBtn').prop('disabled', true);
}

function projectValidation() 
{
    var data = new FormData();
    data.append("function", "checkProjectExistance");
    data.append("name", $.trim($("#projectName").val()));
    
    if($("#projectStatus").val() == null || $.trim($("#projectName").val()) == "")  { $('#saveProjectBtn').prop('disabled', true); }
    else 
    {   
        axios.post("../Project/projectController.php", data)
        .then((res) => 
        {
            if(res.data)
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
        location.reload(); // Refreshes Page as Projects is loaded from PHP, not Javascript
    })
}