$(document).ready(function() 
{
  $('.createComment').summernote
  ({
      height: 150,
      toolbar: 
      [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough' ]],
        ['para', ['ul', 'ol',]],
      ]
  });
});

function loadComment(ticketId)
{
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ticketController.php?ticketId="+ticketId, true)
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var ticketJSON = JSON.parse(this.responseText);
            console.log(ticketJSON);
        }
    }
    xmlhttp.send();
}

function saveComment()
{
  if ($('.createComment').summernote("isEmpty"))
  {
    console.log("Comment Section is empty");
  }
  else 
  {
    // variable userId is available for User Id logged in
    // variable ticketId is available for Ticket Id
    console.log("User Id " + userId + " And the Ticket Id is " + ticketId);
    // var newComment = document.getElementById("createComment").value;
    // var url = "ticketController.php";
    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.open("GET", "projectController.php?projectId="+id, true)
    // xmlhttp.onreadystatechange = function() 
    // {
    //     if (this.readyState == 4 && this.status == 200)
    //     {

    //     }
    // }
    // xmlhttp.send();
  }
}