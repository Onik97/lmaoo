import Navbar from "../public/navbar.js";

$(document).ready(() => { Navbar.accountActiveTab(); Admin.loadActiveUsers(); })

class Admin{
    static activeSelect(){

        let selectValue = $("#adminSelect").val();
    
        if (selectValue == "Active") Admin.loadActiveUsers();
        if (selectValue == "inActive") Admin.loadInActiveUsers();
        else return;
    }

    static loadActiveUsers(){

       var data = new FormData();
       data.append("function", "getAdminActiveUsers");
    
       axios.post("../Admin/target.php", data)
       .then(response =>
       {
           var json = response.data;
           $("#admin-table").find("tr:gt(0)").remove();
    
           for (let i = 0; i < json.length; i++)
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

    static loadInActiveUsers(){

       var data = new FormData();
       data.append("function", "getAdminInActiveUsers");
    
       axios.post("../Admin/target.php", data)
       .then(response =>
       {
           var json = response.data;
           $("#admin-table").find("tr:gt(0)").remove();
    
           for (let i = 0; i < json.length; i++)
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
}

$('#adminSelect').change(function(){Admin.activeSelect(this.value)});