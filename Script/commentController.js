$(document).ready(function() 
{
  loadComments();

  $('.createComment').summernote
  ({
      height: 150,
      toolbar: 
      [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough' ]],
        ['para', ['ul', 'ol']],
      ]
  });
});

function loadComments()
{
  // variable userId is available for User Id logged in
  // variable ticketId is available for Ticket Id
  var data = new FormData();
  data.append('function', "loadComments");
  data.append('ticketId', ticketId);

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'ticketController.php', true);
  xhr.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
      {
        var ticketJSON = JSON.parse(this.responseText);
                document.getElementById("commentList").innerHTML = 
                `
                ${ticketJSON.map(function(comment)
                    {
                      if (userId == comment.userId || userLevel == 2)
                      {
                        return `
                        <div id="comments">
                            <img class="CommentImages" src="../Images/paperclip.png"></img>
                            <img class="CommentImages" src="../Images/delete.png" data-toggle="modal" data-target="#CommentModal" onclick="deletePrompt(${comment.commentId})" role="button"></img>
                            <img class="CommentImages" src="../Images/edit.png" onclick=editComment(${comment.commentId}) role="button"></img>   
                            <p>Comment by ${comment.forename + " " + comment.surname}</p>
                            <div class="comment${comment.commentId}">${comment.commentContent}</div>
                        </div>
                        `;
                      }
                      else 
                      {
                        return `
                        <div id="comments">
                            <img class="CommentImages" src="../Images/paperclip.png"></img> 
                            <p>Comment by ${comment.forename + " " + comment.surname}</p>
                            <div class="comment${comment.commentId}">${comment.commentContent}</div>
                        </div>
                        `;
                      }
                    }).join('')}
                `;
      }
      
  }
  xhr.send(data);
}

function editComment(commentId)
{
    $('.comment'+commentId).summernote
    ({
      focus: true,
      enter: false,
      toolbar: 
      [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough' ]],
        ['para', ['ul', 'ol']],        
      ]
    });

    $('.comment'+commentId).on('summernote.keydown', function(we, e) {
      if(e.shiftKey && e.keyCode == 13)
      {
        var newComment = $('.comment'+commentId).summernote('code');
        var newCommentStripped = newComment.replace(/<[^>]*>?/gm, "");
        
        if ($('.comment'+commentId).summernote("isEmpty") || newCommentStripped.trim().length == 0)
        {
          console.log("Field is Empty");
        }		
        else if (newComment.length > 255)
        {
          console.log("Too much characters");
        }
        else 
        {
          updateComment(commentId, newComment);
          $('.comment'+commentId).summernote('destroy');       
        }
      }
    });
}

function updateComment(id, newContent)
{
  var data = new FormData();
  data.append('function', "updateComment");
  data.append('commentId', id);
  data.append('newComment', newContent)

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'ticketController.php', true);
  xhr.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
      {
        console.log(this.responseText);
      }
  }
  xhr.send(data);
}

function saveComment()
{
  var commentContent = $('.createComment').summernote('code');
  var newCommentStripped = commentContent.replace(/<[^>]*>?/gm, "");
  if ($('.createComment').summernote("isEmpty") || newCommentStripped.trim().length == 0)
  {
		document.getElementById("notenoughchars").removeAttribute("hidden");
		document.getElementById("manychars").setAttribute("hidden");	
  }		
  else if (commentContent.length > 255)
  {
		document.getElementById("manychars").removeAttribute("hidden");
		document.getElementById("notenoughchars").setAttribute("hidden");
  }
  else 
  {
    // variable userId is available for User Id logged in
    // variable ticketId is available for Ticket Id
    var data = new FormData();
    data.append('function', "createComment");
    data.append('commentContent', commentContent);
    data.append('ticketId', ticketId);
    data.append('userId', userId);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ticketController.php', true);
    xhr.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200)
        {
          console.log(this.responseText);
          $('.createComment').summernote('code', ""); // Empties the Comments once it is submitted
          loadComments(); // Loads comments once you submit it
        }
    }
    xhr.send(data);
  }
}

function deletePrompt(commentId)
{
  document.getElementById("Modal-head").innerHTML = "Delete Comment";
  document.getElementById("summernoteDiv").style.display = "none"
  document.getElementById("prompt").style.display = "block"
  document.getElementById("prompt").innerHTML = "Are you sure you want to delete this comment?";
	document.getElementById("Modal-footer").innerHTML = `
	<div class="modal-footer">
		<input class="btn btn-primary" type="submit" value="Delete Comment" onclick="deleteComment(${commentId})">
    </div>
	`;
}

function deleteComment(commentId)
{
    // variable userId is available for User Id logged in
    // variable ticketId is available for Ticket Id
    var data = new FormData();
    data.append('function', "deleteComment");
    data.append('commentId', commentId);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ticketController.php', true);
    xhr.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200)
        {
          console.log(this.responseText);
        }
    }
    xhr.send(data);

  $('#CommentModal').modal('hide'); // This should close the modal, make sure this is in the last line of this function
  loadComments();
 }
 
 function briefDescription()
{
  document.getElementById("Modal-head").innerHTML = "Brief Description";
  document.getElementById("summernoteDiv").style.display = "none"
  document.getElementById("prompt").style.display = "block"
  document.getElementById("prompt").innerHTML = "Testing";
  document.getElementById("Modal-footer").innerHTML = `
	<div class="modal-footer">
		<input class="btn btn-primary" type="submit" value="wip">
    </div>
	`;
}

 function People()
{
  document.getElementById("Modal-head").innerHTML = "People";
  document.getElementById("summernoteDiv").style.display = "none"
  document.getElementById("prompt").style.display = "block"
  document.getElementById("prompt").innerHTML = "Testing / Click here to assign to yourself";
  document.getElementById("Modal-footer").innerHTML = `
	<div class="modal-footer">
		<input class="btn btn-primary" type="submit" value="wip">
    </div>
	`;
}

 function Details()
{
  document.getElementById("Modal-head").innerHTML = "Details infomation";
  document.getElementById("summernoteDiv").style.display = "none"
  document.getElementById("prompt").style.display = "block"
  document.getElementById("prompt").innerHTML = "Testing";
  document.getElementById("Modal-footer").innerHTML = `
	<div class="modal-footer">
		<input class="btn btn-primary" type="submit" value="wip">
    </div>
	`;
}