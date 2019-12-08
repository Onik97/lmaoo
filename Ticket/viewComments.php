<script> 
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var ticketId = "<?php echo $ticketId; ?>";
</script>
<h1> Comment Section </h1>
<button onclick="loadComments()">Load Comments - Check Console (F12 - Console) </button>

<div id="commentList">
	<img class="CommentImages" src="../Images/paperclip.png"></img>
	<img class="CommentImages" src="../Images/delete.png"></img>
	<img class="CommentImages" src="../Images/edit.png" data-toggle="modal" data-target="#editCommentModal" role="button"></img>
    <p>$Username Added a comment Username </p>
	<p>$Comment Content</p>
</div>
<?php include("editCommentModal.php"); ?>