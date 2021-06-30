import Navbar from "./navbar.js";
import AdminController from "../Controller/AdminController.js";
import notification from "../Utility/NotificationWrapper.js";

Navbar.accountActiveTab();

// Load users according to what element is selected
$('#adminSelect').change(async function() {
    $("#admin-table").find("tr:gt(0)").remove();
    let json = await AdminController.getUsers(this.value);
    for (let i = 0; i < json.length; i++)
    {
        let newRow = document.getElementById("admin-table").insertRow(-1);
        let cell1 = newRow.insertCell(0);
        let cell2 = newRow.insertCell(1);
        let cell3 = newRow.insertCell(2);
        let cell4 = newRow.insertCell(3);
        let cell5 = newRow.insertCell(4);

        $(cell1).append(document.createTextNode(json[i].username));
        $(cell2).append(document.createTextNode(json[i].forename));
        $(cell3).append(document.createTextNode(json[i].surname));
        $(cell4).append(document.createTextNode(json[i].level));
        $(cell5).append($("<i>", { class:"fas fa-user-edit", value: `${json[i].userId}`, "data-toggle": "modal", "data-target": "#adminModal" }));
    }
});

// Load user on User Modal when clicking on Edit User Icon
$(document).on('click', '.fas.fa-user-edit', async function() {
    let userId = $(this).attr('value');
    let {forename, surname, username, level, isActive} = await AdminController.getUserById(userId);

    $("#adminFullname").val(`${forename} ${surname}`);
    $("#adminUsername").val(`${username}`);
    isActive == 1 ? $("#adminUserToggle").attr("checked", true) : $("#adminUserToggle").attr("checked", false)
    $("#userLevelSelect").val(level);
    $("#userIdParagraph").html(userId);
});

