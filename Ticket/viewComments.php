<script> 
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var ticketId = "<?php echo $ticketId; ?>";
</script>
<script type="text/javascript" src="../Script/commentController.js"></script>
<h1> Comment Section </h1>
<div id="commentList">
</div>
<?php include("ticketModal.php"); ?>