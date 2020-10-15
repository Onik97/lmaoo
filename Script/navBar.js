let navBarActive = document.getElementById("navBarActive").innerHTML;

(navBarActive == "homePage") ? (document.getElementById("homeNav").classList.add("active"))
: (navBarActive == "projectPage" || navBarActive == "ticketPage") ? (document.getElementById("projectNav").classList.add("active"))
: (navBarActive == "registerPage" || navBarActive == "loginPage" || navBarActive == "adminPage") ? (document.getElementById("accountNav").classList.add("active"))
: null;

function searchBar() 
{
    let searchbarText = $("#searchBarInput").html();
    if (searchbarText == 0) return false;

    loadTicketsWithProgressFromServer(searchbarText)
    .then (response => 
    {
        var json = response.data;
        console.log(json);
    })
}

function searchBarBtn() {
    searchBar();
}