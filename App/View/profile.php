<p id="navBarActive" hidden>profilePage</p>

<h1 class="headings">Profile Page</h1>
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


        <h2>Reset Password</h2>
            <div class="form-group">
                <label>Current Password</label>
                <input class="form-control" id="Password" name="Password" required>
                <small id="PasswordMessage" hidden></small> 
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input class="form-control" id="editPassword" name="editPassword" required>
                <small id="editPasswordMessage" hidden></small> 
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <input class="form-control" id="confirmPassword" name="confirmPassword" required>
                <small id="confirmPasswordMessage" hidden></small> 
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

<div class="link">
    <p1>Linked With Github</p1> &nbsp <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" style=”width:40px;height:20px;">  
</div>
<div class="link"> 
    <p2>Linked With Discord</p2> &nbsp <img src="https://preview.redd.it/s9biyhs4lix61.jpg?auto=webp&s=c600a95eff95b3e9406a8b913c6aa3988b5e3a8b" style=”width:40px;height:20px;">   
</div>
