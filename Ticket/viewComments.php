<script> 
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var ticketId = "<?php echo $ticketId; ?>";
</script>
<h1> Comment Section </h1>
<button onclick="loadComments()">Load Comments</button>
<div id="commentList">
</div>
<?php include("editCommentModal.php"); ?>