<h1> Create Comment </h1>
<div ID="notenoughchars" class="alert alert-warning " role="alert" hidden>The text field is empty!</div>
<div ID="manychars" class="alert alert-warning " role="alert" hidden>Text is to long inside text field!</div>
<script> 
var userId = "<?php echo $userLoggedIn->getId(); ?>"; 
var ticketId = "<?php echo $ticketId; ?>";
</script>
<script type="text/javascript" src="../Script/commentController.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<textarea id="createComment" class=createComment name="editordata" required></textarea>
<button onclick="saveComment()">Save</button> 