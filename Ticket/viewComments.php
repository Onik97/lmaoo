<script> 
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var ticketId = "<?php echo $ticketId; ?>";
</script>
<h1> Comment Section </h1>
<button onclick="loadComments()">Load Comments - Check Console (F12 - Console) </button>
<center>
<div id="commentList">
		<img class="CommentImages" src="../Images/paperclip.png"></img>
		<img class="CommentImages" src="../Images/delete.png"></img>
		<img class="CommentImages" src="../Images/edit.png" data-toggle="modal" data-target="#editCommentModal" role="button"></img>
		<p align="left">$Username Added a comment Username </p>
		<p align="left">$Comment Content</p>
</div>
<div id="commentList">
		<img class="CommentImages" src="../Images/paperclip.png"></img>
		<img class="CommentImages" src="../Images/delete.png"></img>
		<img class="CommentImages" src="../Images/edit.png" data-toggle="modal" data-target="#editCommentModal" role="button"></img>
		<p align="left">$Username Added a comment Username </p>
		<p align="left">$Comment Content</p>
</div>
</center>
<?php include("editCommentModal.php"); ?>