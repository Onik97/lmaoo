let homeNav = document.getElementById("homeNav");
let aboutNav = document.getElementById("aboutNav");
let projectNav = document.getElementById("projectNav");


window.addEventListener("pageshow", checkForActive);


function checkForActive() {
    if (homeNav.classList.contains("active"))
    {
        document.getElementById("aboutNav").classList.replace("active")
        document.getElementById("projectNav").classList.replace("active")
        console.log("homeNav is active")
    }
    else
    {
        console.log("homeNav is not active")
    }
}