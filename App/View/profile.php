<p id="navBarActive" hidden>profilePage</p>

<h1>Profile Page</h1>
    <div class="modal-body">    
        <label>Upload Profile Picture</label>
        <div class="input-group my-2">
            <div class="input-group-prepend">
                <button class="input-group-text" id="uploadImageBtn" disabled onclick="uploadImage()">Upload</button>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="uploadImage" aria-describedby="uploadImageBtn" onchange="validateImage()">
                <label class="custom-file-label" for="uploadImage">Choose file</label>
            </div>
        </div>
        <div id="uploadImageText" hidden>
            <small>Invalid file type.</small>
        </div>
        
        <form action="../User/target.php" method="POST" onkeyup="userEditValidation(); checkUserDup();">
            <div class="form-group">
                <label>Forename</label>
                <input class="form-control" id="editForename" name="editForename" required>
            </div>

            <div class="form-group">
                <label>Surname</label>
                <input class="form-control" id="editSurname" name="editSurname" required>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input class="form-control" id="editUsername" name="editUsername" required>
                <small id="editUsernameMessage" hidden></small> 
            </div>
    </div>
            <input type="hidden" name="function" value="update">
            <input type="hidden" name="editUserId">

            <div class="modal-footer">
                <input id="editUserBtn" class="btn btn-primary" type="submit" value="Save Changes" disabled>
            </div>
        </form>
    </div>
</div>
</div> 
</div>