<script> 
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var ticketId = "<?php echo $ticketId; ?>";
</script>
<h1> Comment Section </h1>
<button onclick="loadComments()">Load Comments - Check Console (F12 - Console) </button>

<div id="commentList">
	<img class="CommentImages" src="../Images/AttachmentIcon.png"></img>
	<img class="CommentImages" src="../Images/EditIcon.png" data-toggle="modal" data-target="#editCommentModal" role="button"></img>
	<img class="CommentImages" src="../Images/DeleteIcon.png"></img>
    <p>$Username Added a comment</p>
	<p>$Comment Content goes here</p>
</div>
<?php include("editCommentModal.php"); ?>