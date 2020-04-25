let navBarActive = document.getElementById("navBarActive").innerHTML;

if (navBarActive = "homePage")
    {
        document.getElementById("homeNav").classList.add("active")
        console.log("homepage is open")
    }
    else if (navBarActive = "aboutPage")
    {
        document.getElementById("aboutNav").classList.add("active")
        console.log("aboutPage is open")
    }
    else if (navBarActive = "projectPage")
    {
        document.getElementById("projectNav").classList.add("active")
        console.log("projectPage is open")
    }
    else if (navBarActive = "loginPage")
    {
        document.getElementById("accountNav").classList.add("active")
        console.log("accountPage is open")
    }
    else if (navBarActive = "registerPage")
    {
        document.getElementById("accountNav").classList.add("active")
        console.log("accountPage is open")
    }
    else 
    {
        console.log("nothing is open")
    }
