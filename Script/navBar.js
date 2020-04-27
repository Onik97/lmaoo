let navBarActive = document.getElementById("navBarActive").innerHTML;

if (navBarActive == "homePage")
{
    document.getElementById("homeNav").classList.add("active")
}
else if (navBarActive == "aboutPage")
{
    document.getElementById("aboutNav").classList.add("active")
}
else if (navBarActive == "projectPage")
{
    document.getElementById("projectNav").classList.add("active")
}
else if (navBarActive == "registerPage" || navBarActive == "loginPage" || navBarActive == "adminPage")
{
    document.getElementById("accountNav").classList.add("active")
}