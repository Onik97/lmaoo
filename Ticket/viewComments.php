<script> 
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var ticketId = "<?php echo $ticketId; ?>";
</script>
<h1> Comment Section </h1>
<button onclick="loadComments()">Load Comments - Check Console (F12 - Console) </button>
<script type="text/javascript" src="../Script/CommentModal.js"></script>

<div id="commentList">
	<img class="CommentImages" src="../Images/paperclip.png"></img>
	<img class="CommentImages" src="../Images/delete.png" data-toggle="modal" data-target="#CommentModal" onclick="deleteComment()" role="button"></img>
	<img class="CommentImages" src="../Images/edit.png" data-toggle="modal" data-target="#CommentModal" onclick="editComment()" role="button"></img>
    <p>$Username Added a comment Username </p>
	<p>$Comment Content</p>
</div>
<?php include("CommentModal.php"); ?>