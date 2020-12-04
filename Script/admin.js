$(document).ready(function() 
{
  loadActiveUsers();
});

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

           console.log(json);

           $(cell1).append(document.createTextNode(json[i].userId));
           $(cell2).append(document.createTextNode(json[i].username));
           $(cell3).append(document.createTextNode(json[i].forename));
           $(cell4).append(document.createTextNode(json[i].surname));
           $(cell5).append(document.createTextNode(json[i].level));
           $(cell6).append($("<button>").html('Edit User'));

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
           $(cell6).append($("<button>").html('Edit User'));;
       }
   })
}

function editUser(userId)
{
    console.log("TBC");
}

function activateUser(userId)
{
    console.log("TBC");
}

function deactivateUser(userId)
{
    console.log("TBC");
}