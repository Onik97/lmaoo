function userEditValidation()
{
    ($("#editForename").val() == userForename && $("#editSurname").val() == userSurname && $("#editUsername").val() == userUsername) 
    ? $("#editUserBtn").prop("disabled", true) : $("#editUserBtn").prop("disabled", false);

    if ($("#editForename").val().trim().length == 0 || $("#editSurname").val().trim().length == 0 || $("#editUsername").val().trim().length == 0) $("#editUserBtn").prop("disabled", true);    
}

function checkUserDup()
{   
    var editUsername = $("#editUsername").val();
    var data = new FormData();
    data.append('function', "checkUsername");
    data.append('username', editUsername);

    if (userUsername == editUsername) return;

    if ($("#editUsername").val().trim().length == 0) $("#editUserBtn").prop("disabled", true); 
    else 
    {
        checkUsernameFromServer(data)
        .then(response =>
        {
            if (response.data.fromServer == "True")
            {
                $("#editUserBtn").prop("disabled", true);
                $("#editUsernameMessage").html("Username Taken! Try another!").addClass("text-danger").removeAttr("hidden");
                $("#editUsername").addClass("is-invalid");
            }
            else
            {
                $("#editUserBtn").prop("disabled", false);
                $("#editUsernameMessage").removeClass("text-danger").attr("hidden", true);
                $("#editUsername").removeClass("is-invalid");
            }
        })
    }
    
}

function validateImage() 
{
    let imageFile = $("#uploadImage").prop('files')[0];
    // let imageVal = $("#uploadImage").val();
    let imgExt = $('#uploadImage').val().split('.').pop().toLowerCase();
    // imageFile.type.split("/").pop().toLowerCase();

    if (imgExt != "jpeg" && imgExt != "jpg" && imgExt != "png" && imgExt != "bmp" && imgExt != "gif") 
    {   
        $('#uploadImage').addClass('is-invalid');
        $('#uploadImageText').prop('hidden', false).addClass('text-danger');
        $('.custom-file-label').html("Choose file");
        $('#uploadImageBtn').prop("disabled", true);
    }
    else
    {
        $('#uploadImageText').removeClass('text-danger').prop('hidden', true);
        $('#uploadImage').removeClass('is-invalid');
        $('.custom-file-label').html(imageFile.name);
        $('#uploadImageBtn').prop('disabled', false);
    }
}

function uploadImage()
{
    var data = new FormData();
    data.append("function", "uploadProfilePic");
    data.append("userId", userId);
    data.append("image", $("#uploadImage").prop('files')[0]);

    serverUpload(data)
    .then((res) => 
    {
        if(res)
        {
            $("#uploadImageText").addClass("text-success").prop('hidden', false).html('Profile Picture Updated!');
            $("#uploadImageBtn").prop('disabled', true);
        }
    })
}