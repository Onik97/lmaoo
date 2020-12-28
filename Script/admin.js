$(document).ready(function() 
{
  loadActiveUsers();
});

function activeSelect()
{
    let selectValue = $("#adminSelect").val();

    if (selectValue == "Active")loadActiveUsers();
    if (selectValue == "inActive")loadInActiveUsers();
    else return;
}

function loadActiveUsers()
{
   var data = new FormData();
   data.append("function", "getAdminActiveUsers");

   axios.post("../User/adminController.php", data)
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
           $(cell6).append($("<button>", { id : "deactivateUserBtn" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : `deactivateUserPrompt(${json[i].userId})`}).html("Deactivate User"));
           $(cell6).append($("<button>", { id : "resetPasswordTableBtn" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : `passwordResetPrompt(${json[i].userId})`}).html("Reset Password"));
           $(cell6).append($("<button>", { id : "updateUserLevel" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : `updateUserLevelPrompt(${json[i].userId})`}).html("Update User Level"));
       }
   })
}

function loadInActiveUsers()
{
   var data = new FormData();
   data.append("function", "getAdminInActiveUsers");

   axios.post("../User/adminController.php", data)
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
           $(cell6).append($("<button>", { id : "activateUserBtn" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : `activateUserPrompt(${json[i].userId})`}).html("Activate User"));
           $(cell6).append($("<button>", { id : "resetPasswordTableBtn" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : `passwordResetPrompt(${json[i].userId})`}).html("Reset Password"));
           $(cell6).append($("<button>", { id : "updateUserLevel" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : `updateUserLevelPrompt(${json[i].userId})`}).html("Update User Level"));
       }
   })
}

function activateUserPrompt(userIdSelected)
{
    $("#admin-modal-title").html("Edit User Info"); 
    let adminEditDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let adminSelectLabel = $("<label>").html("Are you sure you want to activate this user?");
    
    $("#admin-modal-body").html("").append(adminEditDiv);
    $(adminEditDiv).append(adminSelectLabel);

    $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "activateBtn", onclick : `activateUser(${userIdSelected})`}).html("Activate User"))
}

function activateUser(userIdSelected)
{
    let data = new FormData();
    data.append("function", "activateUser");
    data.append("userId", userIdSelected);

    axios.post("../User/adminController.php", data)
    .then(() =>
    {
        overHang("success", "User has been activated");
        $('#admin-modal').modal('hide');
        loadActiveUsers();
    })
}


function deactivateUserPrompt(userIdSelected)
{
    $("#admin-modal-title").html("Edit User Info"); 
    let adminEditDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let adminSelectLabel = $("<label>").html("Are you sure you want to deactivate this user?");
    
    $("#admin-modal-body").html("").append(adminEditDiv);
    $(adminEditDiv).append(adminSelectLabel);

    $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "deactivateBtn", onclick : `deactivateUser(${userIdSelected})`}).html("Deactivate User"))
}

function deactivateUser(userIdSelected)
{
    let data = new FormData();
    data.append("function", "deactivateUser");
    data.append("userId", userIdSelected);

    axios.post("../User/adminController.php", data)
    .then(() =>
    {
        overHang("success", "User has been deactivated");
        $('#admin-modal').modal('hide');
        loadActiveUsers();
    })
}

function passwordResetPrompt(userIdSelected)
{
    $("#admin-modal-title").html("Password Reset"); 
    let adminEditDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let adminSelectLabel = $("<label>").html("Are you sure you want to reset your password?");

    $("#admin-modal-body").html("").append(adminEditDiv);
    $(adminEditDiv).append(adminSelectLabel);

    $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "resetPasswordBtn", onclick : `resetPassword(${userIdSelected})`}).html("Reset Password"))
}

function resetPassword(userIdSelected)
{
    let data = new FormData();
    data.append("function", "resetPassword");
    data.append("userId", userIdSelected);

    axios.post("../User/adminController.php", data)
    .then(() =>
    {
        overHang("success", "Password has been reset");
        $('#admin-modal').modal('hide');
        loadActiveUsers();
    })
}

function updateUserLevelPrompt(userIdSelected)
{
    $("#admin-modal-title").html("Update User Level");
    let adminSelecterLabel = $("<label>").html("Please select a level for the user");
    $("#admin-modal-header").append(adminSelecterLabel);

    let adminEditDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let adminSelecter = $("<select>", { id : 'userLevelSelecter'});
    let adminSelectoption1 = $("<option>").val(1).html('Developer');
    let adminSelectoption2 = $("<option>").val(2).html('Manager');
    let adminSelectoption3 = $("<option>").val(3).html('Admin');
    let adminSelectoption4 = $("<option>").val(4).html('Super User');

    $(adminSelecter).append(adminSelectoption1, adminSelectoption2, adminSelectoption3, adminSelectoption4);

    $("#admin-modal-body").html("").append(adminEditDiv);
    $(adminEditDiv).append(adminSelecter);

    let SelectedUserLevel = '1';
    $("#userLevelSelecter").change(function(){
        let SelectedUserLevel = $(this).children("option:selected").val();
        return SelectedUserLevel;
    });
    // $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "updateUserLevelBtn", onclick : `resetPassword(${userIdSelected}${SelectedUserLevel})`}).html("Update User Level"))
    $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-danger", type : "text", id : "updateUserLevelBtn", onclick : `userCheck(${userIdSelected},${SelectedUserLevel})`}).html("Update User Level"))
}

function userCheck(userIdSelected, SelectedUserLevel)
{
    console.log(userIdSelected, SelectedUserLevel);
}