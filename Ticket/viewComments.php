<script> 
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var ticketId = "<?php echo $ticketId; ?>";
</script>
<script type="text/javascript" src="../Script/CommentModal.js"></script>
<script type="text/javascript" src="../Script/commentController.js"></script>
<h1> Comment Section </h1>
<button onclick="loadComments()">Load Comments - Check Console (F12 - Console) </button>
<div id="commentList">
</div>
<?php include("CommentModal.php"); ?>