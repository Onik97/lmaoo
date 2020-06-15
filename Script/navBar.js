let navBarActive = document.getElementById("navBarActive").innerHTML;

(navBarActive == "homePage") ? (document.getElementById("homeNav").classList.add("active"))
    : (navBarActive == "aboutPage") ? (document.getElementById("aboutNav").classList.add("active"))
    : (navBarActive == "projectPage" || navBarActive == "ticketPage") ? (document.getElementById("projectNav").classList.add("active"))
    : (navBarActive == "registerPage" || navBarActive == "loginPage" || navBarActive == "adminPage") ? (document.getElementById("accountNav").classList.add("active"))
    : null;