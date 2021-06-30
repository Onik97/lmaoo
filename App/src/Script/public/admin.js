import Navbar from "./navbar.js";
import AdminController from "../Controller/AdminController.js";

Navbar.accountActiveTab();

// Load users according to what element is selected
$('#adminSelect').change(async function() {
    $("#admin-table").find("tr:gt(0)").remove();
    let json = await AdminController.getUsers(this.value);
    for (let i = 0; i < json.length; i++)
    {
        let newRow = document.getElementById("admin-table").insertRow(-1);
        let cell2 = newRow.insertCell(0);
        let cell3 = newRow.insertCell(1);
        let cell4 = newRow.insertCell(2);
        let cell5 = newRow.insertCell(3);
        let cell6 = newRow.insertCell(4);

        $(cell2).append(document.createTextNode(json[i].username));
        $(cell3).append(document.createTextNode(json[i].forename));
        $(cell4).append(document.createTextNode(json[i].surname));
        $(cell5).append(document.createTextNode(json[i].level));
        $(cell6).append($("<i>", { class:"fas fa-user-edit", value: `${json[i].userId}`, "data-toggle": "modal", "data-target": "#adminModal" }));
    }
});