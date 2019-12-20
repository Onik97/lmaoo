<div class="modal fade" id="CommentModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="Modal-head"><b>Edit Comment</b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<div class="modal-body" id="Modal-body">
				<p id="prompt"></p>
				<div id="summernoteDiv">
				<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
				<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
				<textarea id="editComment" class="editComment" name="editordata"></textarea>
				</div>
			</div>
			<div class="modal-footer" id="Modal-footer">
				<input class="btn btn-primary" type="submit" value="Save Changes">
			</div>
		</div>
	</div>
</div>