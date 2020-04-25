$('form')
.each(function(){
    $(this).data('serialized', $(this).serialize())
})
.on('change input', function(){
    $(this)				
        .find('input:submit, button:submit')
            .attr('disabled', $(this).serialize() == $(this).data('serialized'))
    ;
 })
.find('input:submit, button:submit')
    .attr('disabled', true);

function checkUserDup()
{   
    var editUsername = document.getElementById("editUsername").value;
    var data = new FormData();
    data.append('function', "checkUsername");
    data.append('username', editUsername);

    checkUsernameFromServer(data)
    .then((response) =>
    {
        var responseFromServer = response.data.fromServer;

        if (responseFromServer == "True")
        {
            document.getElementById("editUserBtn").disabled = true;
            document.getElementById("editUsernameMessage").innerHTML = "Username Taken! Try another!";
            document.getElementById("editUsername").classList.add("is-invalid"); 
            document.getElementById("editUsernameMessage").removeAttribute("hidden");  
        }
        else
        {
            document.getElementById("editUserBtn").disabled = false;
            document.getElementById("editUsernameMessage").innerHTML = "";
            document.getElementById("editUsername").classList.remove("is-invalid"); 
            document.getElementById("editUsernameMessage").setAttribute("hidden");
        }
    })
    .catch((response) => {})
}