$(document).ready(function() 
{
  loadActiveUsers(active);
});
let active = 1;
let active = 1; // this is used currently in later pages to make sure the user wanted this certain action on the selected Active/not-active group.

function activeSelect()
{
    let selectValue = $("#adminSelect").val();

    if (selectValue == "Active"){active = 1, loadActiveUsers(active);}
    if (selectValue == "inActive"){active = 0, loadInActiveUsers(active);}
    else return;
}

function loadActiveUsers(active)
{
    console.log(active);
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
            if (userLevel > 3)$(cell6).append($("<button>", { id : "editUserBtn" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : "editUser(userId, active)"}).html("Edit User"));

       }
   })
}

function loadInActiveUsers(active)
{
    console.log(active);
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
           if (userLevel > 3)$(cell6).append($("<button>", { id : "editUserBtn" , "data-toggle" : "modal" , "data-target" : "#admin-modal" , onclick : "editUser(userId, active)"}).html("Edit User"));
       }
   })
}

function editUser(userId, active)
{
    $("#admin-modal-title").html("Edit User Info");

    let adminEditDiv = $("<div>", {"class" : "form-group modal-content-1"});
    let adminSelectLabel = $("<label>").html("Activate/Deactive User:");
    let adminOptionSelect = $("<select>", {class : "form-control", id : "adminSelect"});
    let adminOptionSelect = $("<select>", {class : "form-control adminSelector", id : "adminSelect"});
    let adminOptioninput1 = $('<option>', {id : 'adminOptionInput1'}).val(1).html('Activate');
    let adminOptioninput2 = $('<option>', {id : 'adminOptionInput2'}).val(0).html('Deactivate');
    let adminValidationSmall = $("<small>", {id : "adminValidationSmall"});
    $("#admin-modal-body").html("").append(adminEditDiv);
    $(adminEditDiv).append(adminSelectLabel);
    $(adminEditDiv).append(adminOptionSelect);
    $(adminOptionSelect).append(adminOptioninput1);
    $(adminOptionSelect).append(adminOptioninput2);
    $(adminEditDiv).append(adminValidationSmall);

    active == 1 ? $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-primary", type : "text", id : "saveUserChange", onclick : "deactivateUser(userId)"}).html("Save"))
    : $("#admin-modal-footer").html("").append($("<button>", {class : "btn btn-primary", type : "text", id : "saveUserChange", onclick : "activateUser(userId)"}).html("Save"))
    
    $("#adminSelect").change(function(){
        console.log($(this).val());
	
        ($(this).val() == 1 && active == 1) ? ($('#saveUserChange').prop('disabled', true))
            : ($(this).val() == 1 && active == 0) ? ($('#saveUserChange').prop('disabled', false))
                : ($(this).val() == 0 && active == 0) ? ($('#saveUserChange').prop('disabled', true))
                    : ($(this).val() == 0 && active == 1) ? ($('#saveUserChange').prop('disabled', false))
                        : console.log("we dun fucked up");
    })
}

function activateUser(userId)
{
    console.log("TBC");
}

function deactivateUser(userId)
{
    console.log("TBC");
}