$(document).ready(function() 
{
  $('.createComment').summernote(
    {
      height: 150,
      toolbar: 
      [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough' ]],
        ['para', ['ul', 'ol',]],
      ]
    });
});

function saveComment()
{
  if ($('.createComment').summernote("isEmpty"))
  {
    // Should not do anything, 
  }
  else 
  {
    var newComment = document.getElementById("createComment").value;
    console.log(newComment);
  }
}