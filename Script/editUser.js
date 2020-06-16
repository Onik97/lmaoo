$('form').each(() => $(this).data('serialized', $(this).serialize())
.on('change input', () => 
{
    $(this).find('input:submit, button:submit').attr('disabled', $(this).serialize() == $(this).data('serialized'));
})
.find('input:submit, button:submit').attr('disabled', true));

function checkUserDup()
{   
    var editUsername = document.getElementById("editUsername").value;
    var data = new FormData();
    data.append('function', "checkUsername");
    data.append('username', editUsername);

    if (userUsername == editUsername) return;

    checkUsernameFromServer(data)
    .then((response) =>
    {
        if (response.data.fromServer == "True")
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
            document.getElementById("editUsername").classList.toggle("is-invalid", false); 
            document.getElementById("editUsernameMessage").classList.toggle("text-danger", false); 
            document.getElementById("editUsernameMessage").classList.toggle("text-success", false); 
            document.getElementById("editUsernameMessage").setAttribute("hidden" , false);
        }
    })
    
}

function validateImage() 
{
    let imageFile = document.getElementById("uploadImage").files[0];
    let imgExt = imageFile.type.split("/").pop().toLowerCase();

    if (imgExt != "jpeg" && imgExt != "jpg" && imgExt != "png" && imgExt != "bmp" && imgExt != "gif") 
    {
        document.getElementById("uploadImageText").classList.add("text-danger");
        document.getElementById("uploadImage").classList.add("is-invalid");
        document.getElementById("uploadImageText").hidden = false;
        $('.custom-file-label').html("Choose file");
        document.getElementById("uploadImageBtn").disabled = true;
    }
    else
    {
        document.getElementById("uploadImageText").classList.toggle("text-danger", false);
        document.getElementById("uploadImage").classList.toggle("is-invalid", false);
        document.getElementById("uploadImageText").hidden = true;
        $('.custom-file-label').html(imageFile.name);
        document.getElementById("uploadImageBtn").disabled = false;
    }
}

function uploadImage()
{
    console.log("Hello World");
}