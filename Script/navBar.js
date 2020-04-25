let homeNav = document.getElementById("homeNav");
let aboutNav = document.getElementById("aboutNav");
let projectNav = document.getElementById("projectNav");
let accountNav = document.getElementById("accountNav");


window.addEventListener("pageshow", checkForActive);


function checkForActive() {
    if (homeNav.classList.contains("active"))
    {
        document.getElementById("aboutNav").classList.replace("active", "notActive")
        document.getElementById("projectNav").classList.replace("active", "notActive")
        document.getElementById("accountNav").classList.replace("active", "notActive")
        console.log("homeNav is active")
    }
    else if (aboutNav.classList.contains("active"))
    {
        document.getElementById("homeNav").classList.replace("active", "notActive")
        document.getElementById("projectNav").classList.replace("active", "notActive" )
        document.getElementById("accountNav").classList.replace("active", "notActive")
        console.log("aboutNav is active")
    }
    else if (projectNav.classList.contains("active"))
    {
        document.getElementById("homeNav").classList.replace("active", "notActive")
        document.getElementById("aboutNav").classList.replace("active", "notActive" )
        document.getElementById("accountNav").classList.replace("active", "notActive")
        console.log("projectNav is active")
    }
    else if (accountNav.classList.contains("active"))
    {
        document.getElementById("homeNav").classList.replace("active", "notActive")
        document.getElementById("aboutNav").classList.replace("active", "notActive" )
        document.getElementById("projectNav").classList.replace("active", "notActive")
        console.log("accountNav is active")
    }
    else
    {
        console.log("nothing is active.")
    }
}
