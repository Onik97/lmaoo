$(document).ready(() => loadActiveUsers());

function activeSelect()
{
    let selectValue = $("#adminSelect").val();

    if (selectValue == "Active") loadActiveUsers();
    if (selectValue == "inActive") loadInActiveUsers();
    else return;
}

function loadActiveUsers()
{
   var data = new FormData();
   data.append("function", "getAdminActiveUsers");

   axios.post("../Admin/target.php", data)
   .then(response =>
   {
       var json = response.data;
       $("#admin-table").find("tr:gt(0)").remove();

       for (i = 0; i < json.length; i++)
       {
           let newRow = document.getElementById("admin-table").insertRow(-1);
           let cell1 = newRow.insertCell(0);
           let cell2 = newRow.insertCell(1);
           let cell3 = newRow.insertCell(2);
           let cell4 = newRow.insertCell(3);
           let cell5 = newRow.insertCell(4);
           let cell6 = newRow.insertCell(5);

           $(cell1).append(document.createTextNode(json[i].userId));
           $(cell2).append(document.createTextNode(json[i].username));
           $(cell3).append(document.createTextNode(json[i].forename));
           $(cell4).append(document.createTextNode(json[i].surname));
           $(cell5).append(document.createTextNode(json[i].level));
           $(cell6).append($("<button>", { id : "editUser" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : `editUserPrompt(${json[i].userId})`}).html("Edit User"));
           $(cell6).append($("<button>", { id : "deactivateUserBtn" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : `deactivateUserPrompt(${json[i].userId})`}).html("Deactivate User"));
       }
   })
}

function loadInActiveUsers()
{
   var data = new FormData();
   data.append("function", "getAdminInActiveUsers");

   axios.post("../Admin/target.php", data)
   .then(response =>
   {
       var json = response.data;
       $("#admin-table").find("tr:gt(0)").remove();

       for (i = 0; i < json.length; i++)
       {

           let newRow = document.getElementById("admin-table").insertRow(-1);
           let cell1 = newRow.insertCell(0);
           let cell2 = newRow.insertCell(1);
           let cell3 = newRow.insertCell(2);
           let cell4 = newRow.insertCell(3);
           let cell5 = newRow.insertCell(4);
           let cell6 = newRow.insertCell(5);

           $(cell1).append(document.createTextNode(json[i].userId));
           $(cell2).append(document.createTextNode(json[i].username));
           $(cell3).append(document.createTextNode(json[i].forename));
           $(cell4).append(document.createTextNode(json[i].surname));
           $(cell5).append(document.createTextNode(json[i].level));
           $(cell6).append($("<button>", { id : "editUser" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : `editUserPrompt(${json[i].userId})`}).html("Edit User"));
           $(cell6).append($("<button>", { id : "activateUserBtn" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : `activateUserPrompt(${json[i].userId})`}).html("Activate User"));
       }
   })
}

function activateUserPrompt(userIdSelected)
{
    $("#admin-modal-header").children().remove()

    $("#admin-modal-title").html("Edit User Info"); 
    let adminEditDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let adminSelectLabel = $("<label>").html("Are you sure you want to activate this user?");
    let adminlabel = $("<p>").html("Please confirm this action")

    $("#admin-modal-header").append(adminlabel);

    $("#admin-modal-body").html("").append(adminEditDiv);
    $(adminEditDiv).append(adminSelectLabel);

    $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "activateBtn", onclick : `activateUser(${userIdSelected})`}).html("Activate User"))
}

function activateUser(userIdSelected)
{
    let data = new FormData();
    data.append("function", "activateUser");
    data.append("userId", userIdSelected);

    axios.post("../Admin/target.php", data)
    .then(() =>
    {
        overHang("success", "User has been activated");
        $('#admin-modal').modal('hide');
        loadActiveUsers();
    })
}

function deactivateUserPrompt(userIdSelected)
{
    $("#admin-modal-header").children().remove()

    $("#admin-modal-title").html("Edit User Info"); 
    let adminEditDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let adminSelectLabel = $("<label>").html("Are you sure you want to deactivate this user?");
    let adminlabel = $("<p>").html("Please confirm this action")

    $("#admin-modal-header").append(adminlabel);
    
    $("#admin-modal-body").html("").append(adminEditDiv);
    $(adminEditDiv).append(adminSelectLabel);

    $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "deactivateBtn", onclick : `deactivateUser(${userIdSelected})`}).html("Deactivate User"))
}

function deactivateUser(userIdSelected)
{
    let data = new FormData();
    data.append("function", "deactivateUser");
    data.append("userId", userIdSelected);

    axios.post("../Admin/target.php", data)
    .then(() =>
    {
        overHang("success", "User has been deactivated");
        $('#admin-modal').modal('hide');
        loadActiveUsers();
    })
}

function passwordResetPrompt(userIdSelected)
{
    $("#admin-modal-header").children().remove()

    $("#admin-modal-title").html("Password Reset"); 
    let adminEditDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let adminSelectLabel = $("<label>").html("Are you sure you want to reset your password?");
    let adminlabel = $("<p>").html("Please confirm this action")

    $("#admin-modal-header").append(adminlabel);

    $("#admin-modal-body").html("").append(adminEditDiv);
    $(adminEditDiv).append(adminSelectLabel);

    $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "resetPasswordBtn", onclick : `resetPassword(${userIdSelected})`}).html("Reset Password"))
}

function resetPassword(userIdSelected)
{
    let data = new FormData();
    data.append("function", "resetPassword");
    data.append("userId", userIdSelected);

    axios.post("../Admin/target.php", data)
    .then(() =>
    {
        overHang("success", "Password has been reset");
        $('#admin-modal').modal('hide');
        loadActiveUsers();
    })
}

function updateUserLevelPrompt(userIdSelected)
{
    $("#admin-modal-header").children().remove()

    $("#admin-modal-title").html("Update User Level");

    let adminSelectLabel = $("<label>").html("Please select a level for the user");
    let adminEditDiv = $("<div>", {class : "form-group modal-content-1"});
    let adminSelecter = $("<select>", { id : 'userLevelSelecter'});
    let adminSelectoption1 = $("<option>").val(1).html('Developer');
    let adminSelectoption2 = $("<option>").val(2).html('Manager');
    let adminSelectoption3 = $("<option>").val(3).html('Admin');
    let adminSelectoption4 = $("<option>").val(4).html('Super User');

    $("#admin-modal-header").append(adminSelectLabel);
    $(adminSelecter).append(adminSelectoption1, adminSelectoption2, adminSelectoption3, adminSelectoption4);

    $(adminEditDiv).append(adminSelecter);
    $("#admin-modal-body").html("").append(adminEditDiv);

    $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "updateUserLevelBtn", onclick : `updateUserLevel(${userIdSelected})`}).html("Update User Level"));
}

function updateUserLevel(userIdSelected)
{
    var userLevelSelected = $("#userLevelSelecter option:selected").val();

    let data = new FormData();
    data.append("function", "updateUserLevel");
    data.append("userId", userIdSelected);
    data.append("chosenUserLevel", userLevelSelected);

    axios.post("../Admin/target.php", data)
    .then(() =>
    {
        overHang("success", "User Level has been changed");
        $('#admin-modal').modal('hide');
        loadActiveUsers();
    })
}

function editUserPrompt(userIdSelected)
{
    $("#admin-modal-header").children().remove()
    $('#admin-modal-footer').children().remove()

    $("#admin-modal-title").html("Update User");

    let adminSelectLabel = $("<label>").html("Please select what you would like to edit");
    let adminEditDiv = $("<div>", {class : "form-group modal-content-1"});
    let adminSelecter = $("<select>", { id : 'editUserSelecter'});
    let adminSelectoption1 = $("<option>").val(1).html('Please select a option');
    let adminSelectoption2 = $("<option>").val(2).html('Update User Level');
    let adminSelectoption3 = $("<option>").val(3).html('Edit Password (wip)');
    let adminSelectoption4 = $("<option>").val(4).html('Reset Password');

    $("#admin-modal-header").append(adminSelectLabel);

    $(adminEditDiv).append(adminSelecter);
    $(adminSelecter).append(adminSelectoption1, adminSelectoption2, adminSelectoption3, adminSelectoption4);

    $("#admin-modal-body").html("").append(adminEditDiv);

    $('#editUserSelecter').on('change',(event) => {


        (event.target.value == 1) ? $('#admin-modal-footer').children().remove()
        : (event.target.value == 2) ? $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "updateUserBtn1", onclick : `updateUserLevelPrompt(${userIdSelected})`}).html("Update User"))
        : (event.target.value == 3) ? $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "updateUserBtn2", onclick : `editPasswordPrompt(${userIdSelected})`}).html("Edit Password (wip)"))
        : (event.target.value == 4) ? $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "updateUserBtn3", onclick : `passwordResetPrompt(${userIdSelected})`}).html("Reset Password"))
        : null;
    });
}