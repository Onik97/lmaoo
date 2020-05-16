$(document).ready(function() 
{
  loadComments();

  $('.createComment').summernote({
    height: 150,
    toolbar: 
    [
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough' ]],
      ['para', ['ul', 'ol']],
    ],
    popover: 
    {
      image: [],
      link: [],
      air: [],
    }
    });
});

function loadComments()
{
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
                      if (userId == comment.userId || userLevel == 4)
                      {
                        return `
                        <div id="comments">
                            <img class="CommentImages" src="../Images/paperclip.png"></img>
                            <img class="CommentImages" src="../Images/delete.png" data-toggle="modal" data-target="#CommentModal" onclick="deletePrompt(${comment.commentId})" role="button"></img>
                            <img class="CommentImages" src="../Images/edit.png" onclick=editComment(${comment.commentId}) role="button"></img>   
                            <p>Comment by ${comment.forename + " " + comment.surname} at <label>${comment.commentCreated}</label></p>
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
  $('.comment'+commentId).summernote({
    height: 150,
    toolbar: 
    [
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough' ]],
      ['para', ['ul', 'ol']],
    ],
    popover: 
    {
      image: [],
      link: [],
      air: [],
    }
    });
    
    $('.comment'+commentId).on('summernote.keydown', function(we, e) {
      if(e.shiftKey && e.keyCode == 13)
      {
        var newComment = $('.comment'+commentId).summernote('code');
        var newCommentStripped = newComment.replace(/<[^>]*>?/gm, "");
        
        if ($('.comment'+commentId).summernote("isEmpty") || newCommentStripped.trim().length == 0)
        {
          overHang("error", "Comment too small!");
        }		
        else if (newComment.length > 255)
        {
          overHang("error", "Comment too large!");
        }
        else 
        {
          updateComment(commentId, newComment);
          $('.comment'+commentId).summernote('destroy');
          overHang("success", "Comment updated successfully!");      
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
  var commentContentStripped = commentContent.replace(/<[^>]*>?/gm, "");
  if ($('.createComment').summernote("isEmpty") || commentContentStripped.trim().length == 0)
  {
    overHang("error", "Comment too small!");
  }		
  else if (commentContent.length > 255)
  {
    overHang("error", "Comment too large!");
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
          overHang("success", "New comment added successfully!");
        }
    }
    xhr.send(data);
  }
}

function deletePrompt(commentId)
{
  document.getElementById("Modal-head").innerHTML = "Delete Comment";
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
          loadComments();
          $('#CommentModal').modal('hide'); 
          overHang("warn", "Comment deleted successfully!");
        }
    }
    xhr.send(data);
 }
 
function briefDescription()
{
  document.getElementById("Modal-head").innerHTML = "Brief Description";
  document.getElementById("prompt").style.display = "block"
  document.getElementById("prompt").innerHTML = "Testing";
  document.getElementById("Modal-footer").innerHTML = `
	<div class="modal-footer">
		<input class="btn btn-primary" type="submit" value="wip">
    </div>
	`;
}

function Details()
{
  document.getElementById("Modal-head").innerHTML = "Details infomation";
  document.getElementById("prompt").style.display = "block"
  document.getElementById("prompt").innerHTML = "Testing";
  document.getElementById("Modal-footer").innerHTML = `
	<div class="modal-footer">
		<input class="btn btn-primary" type="submit" value="wip">
    </div>
	`;
}