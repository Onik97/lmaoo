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

    if (userUsername == editUsername)
    {
        document.getElementById("editUserBtn").disabled = true;
        document.getElementById("editUsernameMessage").innerHTML = "This is already your username";
        document.getElementById("editUsername").classList.add("is-valid");
        document.getElementById("editUsernameMessage").classList.add("text-success"); 
        document.getElementById("editUsernameMessage").removeAttribute("hidden");  
    }
    else 
    {
        checkUsernameFromServer(data)
        .then((response) =>
        {
            var responseFromServer = response.data.fromServer;

            if (responseFromServer == "True")
            {
                document.getElementById("editUserBtn").disabled = true;
                document.getElementById("editUsernameMessage").innerHTML = "Username Taken! Try another!";
                document.getElementById("editUsernameMessage").classList.add("text-danger"); 
                document.getElementById("editUsername").classList.add("is-invalid"); 
                document.getElementById("editUsernameMessage").removeAttribute("hidden");  
            }
            else
            {
                document.getElementById("editUserBtn").disabled = false;
                document.getElementById("editUsernameMessage").innerHTML = "";
                document.getElementById("editUsername").classList.toggle("is-invalid", false); 
                document.getElementById("editUsername").classList.toggle("is-valid", false); 
                document.getElementById("editUsernameMessage").classList.toggle("text-danger", false); 
                document.getElementById("editUsernameMessage").classList.toggle("text-success", false); 
                document.getElementById("editUsernameMessage").setAttribute("hidden");
            }
        })
        .catch((response) => {})
    }
}

function validateImage() 
{
    let imageFile = document.getElementById("uploadImage").files[0];
    let t = imageFile.type.split("/").pop().toLowerCase();

    if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") 
    {
        alert('Please select a valid image file');
        $('.custom-file-label').html("Choose file");
        document.getElementById("uploadImageBtn").disabled = true;
    }
    else
    {
        $('.custom-file-label').html(imageFile.name);
        document.getElementById("uploadImageBtn").disabled = false;
    }
}

function uploadImage()
{
    console.log("Hello World");
}