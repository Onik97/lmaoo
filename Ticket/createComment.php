<h1> Create Comment </h1>
<div ID="notenoughchars" class="alert alert-warning " role="alert" hidden>The text field is empty!</div>
<div ID="manychars" class="alert alert-warning " role="alert" hidden>Text is to long inside text field!</div>
<script> 
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var ticketId = "<?php echo $ticketId; ?>";
</script>
<script type="text/javascript" src="../Script/commentController.js"></script>
<textarea id="createComment" class=createComment name="editordata"></textarea>
<button onclick="saveComment()">Save Comment</button> 