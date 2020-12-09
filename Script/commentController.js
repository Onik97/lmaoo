$(document).ready(() => { loadComments(); loadSummerNote(".createComment"); });

$(".createComment").on('summernote.keydown', (we, e) => e.shiftKey && e.keyCode == 13 ? saveComment(".createComment") : null ); // Shift + Enter 

function loadSummerNote(summerNoteId)
{
  $(summerNoteId).summernote({
    placeholder: "Enter your comment here, Shift + Enter to save",
    height: 125,
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
    $('.note-statusbar').hide();
}

function commentValidation(summerNoteId)
{
  var newComment = $(summerNoteId).summernote('code');
  var newCommentStripped = newComment.replace(/<[^>]*>?/gm, "");

  if ($(summerNoteId).summernote("isEmpty") || newCommentStripped.trim().length == 0)
  {
    overHang("error", "Comment too small!");
    return false;
  }
  else if (newComment.length > 255)
  {
    overHang("error", "Comment too large!");
    return false
  }
  return true;
}

function loadComments()
{
  var ticketId = new URL(window.location.href).searchParams.get("ticketId");

  loadCommentsFromServer(ticketId)
  .then(response => 
    {
      $("#commentList").html(""); // Empties for edit/delete comments
      var json = response.data;
      for (i = 0; i < json.length; i++)
      {
        $("#commentList").append(
          `
          <div id="comments${json[i].commentId}" class="row">
            <div class="col-1">
              <div id="commentThumbnail">
                <img class="profilePicture mt-1" src="${json[i].picture}"></img>
              </div>
            </div>

            <div class="col-8">
                <div id="commentBody" class="mt-2 ml-2">
                    <h6>${json[i].forename + " " + json[i].surname}</h6>
                    <span>${json[i].commentCreated}</span>
                </div>

                <div id="mainComment" class="ml-2 comment${json[i].commentId}">${json[i].commentContent}</div>
            </div>
          `);
          if (userId == json[i].userId || userLevel == 4) $(`#comments${json[i].commentId}`).append(
          `
            <div class="col-2 mt-2 ml-5" id="commentActions">
              <img class="CommentImages" src="../Images/trash.svg" data-toggle="modal" data-target="#ticketPageModal" onclick="deletePrompt(${json[i].commentId})" role="button"></img>
              <img class="CommentImages" src="../Images/pencilsquare.svg" onclick=editComment(${json[i].commentId}) role="button"></img>
            </div>
          `);
      }
    })
}

function editComment(commentId)
{
  loadSummerNote('.comment'+commentId);
  let commentBefore = $('.comment'+commentId).summernote('code');

  $('.comment'+commentId).on('summernote.keydown', (we, e) => 
  {
    if(e.keyCode == 27) cancelComment('.comment'+commentId, commentBefore);

    if(e.shiftKey && e.keyCode == 13) // Shift + Enter
    {
      if (commentValidation('.comment'+commentId))
      {
        saveComment('.comment'+commentId, commentId);
        $('.comment'+commentId).summernote('destroy');
        loadDates();
      }
    }
  });
}

function cancelComment(summernoteId, commentBefore)
{
  $(summernoteId).summernote("code", commentBefore);
  $(summernoteId).summernote("destroy");
}

function saveComment(summernoteId, commentId)
{
  var ticketId = new URL(window.location.href).searchParams.get("ticketId");

  var data = new FormData();
  data.append('commentContent', $(summernoteId).summernote('code'));
  data.append('ticketId', ticketId);
  data.append('userId', userId);
  commentId == null ? data.append('function', "createComment") : data.append('function', "updateComment");
  if (commentId != null) data.append("commentId", commentId);

  if (commentValidation(summernoteId))
  {
    axios.post("../Ticket/ticketController.php", data)
    .then(() =>
    {
      if (commentId == null) $('.createComment').summernote('code', "");
      commentId == null ? overHang("success", "New comment added successfully!") : overHang("success", "Comment successfully edited!"); 
      loadComments(); // Loads comments once you submit it
      updateTicketTime(new URL(window.location.href).searchParams.get("ticketId")).then(() => loadDates());
    })
  }
}

function deletePrompt(commentId)
{
  $("#Modal-head").html("Delete Comment");
  $("#modal-body").html("Are you sure you want to delete this comment?")
  $("#modal-footer").html("").append($("<button>", { class : "btn btn-primary", type : "submit", onclick : `deleteComment(${commentId})` }).html("Delete Comment"))
}

function deleteComment(commentId)
{
    var data = new FormData();
    data.append('function', "deleteComment");
    data.append('commentId', commentId);

    axios.post("../Ticket/ticketController.php", data)
    .then(() =>
    {
      $('#ticketPageModal').modal('hide'); 
      overHang("success", "Comment deleted successfully!");
      updateTicketTime(new URL(window.location.href).searchParams.get("ticketId")).then(() => loadDates());
      loadComments();
    })
 }