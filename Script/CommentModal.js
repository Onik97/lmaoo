function editComment()
{
	document.getElementById("Modal-head").innerHTML = "Edit Comment";
	document.getElementById("Modal-body").innerHTML = "Editing Comment";
	document.getElementById("Modal-footer").innerHTML = `
	<div class="modal-footer">
		<input class="btn btn-primary" type="submit" value="Update Changes">
    </div>
	`;
}

function deleteComment()
{
	document.getElementById("Modal-head").innerHTML = "Delete Comment";
	document.getElementById("Modal-body").innerHTML = "Are you sure you want to delete this comment?";
	document.getElementById("Modal-footer").innerHTML = `
	<div class="modal-footer">
		<input class="btn btn-primary" type="submit" value="Delete Comment">
    </div>
	`;
}