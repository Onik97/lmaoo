$(document).ready(() => darkModeToggleValidator());

let navBarActive = document.getElementById("navBarActive").innerHTML;

(navBarActive == "homePage") ? (document.getElementById("homeNav").classList.add("active"))
    : (navBarActive == "projectPage" || navBarActive == "ticketPage") ? (document.getElementById("projectNav").classList.add("active"))
        : (navBarActive == "registerPage" || navBarActive == "loginPage" || navBarActive == "adminPage" || navBarActive == "managerPage") ? (document.getElementById("accountNav").classList.add("active"))
            : null;

$('#searchBarInput').on("keypress", (e) => { if (e.keyCode == 13) searchBar(); });

function searchBar()
{
    let searchbarText = $("#searchBarInput").val();

    let data = new FormData();
    data.append("function", "checkTicket");
    data.append("ticketId", searchbarText);

    axios.post("../Ticket/target.php", data)
        .then(response => 
            (response.data == true) ? window.location.href = `../Ticket/index.php?ticketId=${searchbarText}` : $("#searchBarInput").addClass('is-invalid'));
}

function darkModeToggleValidator() // Sometimes toggle can be on but dark mode is not 
{
    let darkModeSwitch = $("#darkModeSwitch");

    if (darkModeSwitch.prop("checked"))
    {
        if (!darkmode.isActivated()) darkmode.toggle();
    }
    else if (!darkModeSwitch.prop("checked"))
    {
        if (darkmode.isActivated()) darkmode.toggle();
    }
}

function darkModeToggle()
{
    let darkModeSwitch = $("#darkModeSwitch");

    if (darkModeSwitch.prop("checked"))
    {
        $.cookie("lmaooDarkMode", 1, { path: "/" })
        if (!darkmode.isActivated()) darkmode.toggle();
        (typeof userId == 'undefined') ? null : saveUserDarkMode(1);
    }
    else if (!darkModeSwitch.prop("checked"))
    {
        $.cookie("lmaooDarkMode", 0, { path: "/" })
        if (darkmode.isActivated()) darkmode.toggle();
        (typeof userId == 'undefined') ? null : saveUserDarkMode(0);
    }
}

function saveUserDarkMode(toggle)
{
    let data = new FormData();
    data.append("function", "darkModeToggle");
    data.append("darkMode", toggle);
    data.append("userId", userId);

    axios.post("../User/target.php", data);
}