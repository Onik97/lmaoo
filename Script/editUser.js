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

function userDupCheck()
{
    var editUsername = document.getElementById("editUsername").value;
    var data = new FormData();
    data.append('function', "checkUsername");
    data.append('username', editUsername);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../User/userController.php',);
    xhr.send(data); 
    xhr.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200)
        {
            var response = this.responseText;
            return response; 
        }    
    }
}

function updateEditUser()
{
    var response = userDupCheck();
    console.log(response);

    return false;
}