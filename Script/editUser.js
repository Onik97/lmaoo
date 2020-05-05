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

$(".custom-file-input").on("change", function() {
var fileName = $(this).val().split("\\").pop();
$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function validateImage() {
    var formData = new FormData();
 
    let Imagefile = document.getElementById("customFile").files[0];
 
    formData.append("Filedata", Imagefile);
    let t = Imagefile.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
        alert('Please select a valid image file'); // will add notify.js instead, not sure how to do so leaving this for the moment.
        document.getElementById("customFile").value = '';
        return false;
    }
    else
    {
        return true;
    }
};