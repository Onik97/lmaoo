<p id="navBarActive" hidden>profilePage</p>

<h1 class="heading">Profile Page</h1>
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

<!-- EDIT PASSWORD MODAL -->
<div class="col-sm-2">
    <button type="button" class="btn btn-success" data-toggle='modal' data-target='#editPasswordModal' onclick="editPasswordPrompt()">Edit Password</button>
</div>

<div class="modal fade" id="editPasswordModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title modal-title-custom ml-9 mr-auto text-black" id="editPasswordHead">Reset Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="editPasswordBody">
            <div class="wrapper">
                <label>What is your current password?</label>
                <input type="text" class="search-input form-control" id="passwordName" placeholder="Current Password" onkeyup="projectValidation()">
                <div class="autocom-box"></div>
            </div>
            
            <div class="wrapper">
            <label>Password Update:</label>
                <input type="text" class="search-input form-control" id="newpasswordName" placeholder="New Password" onkeyup="passwordValidation()">    
            </div>

            <div class="wrapper">
            <label>Confirm Password Update:</label>
                <input type="text" class="search-input form-control" id="confirmpasswordName" placeholder="Confirm New Password" onkeyup="passwordValidation()">    
            </div>
            <div class="password-modal-footer" id="editPasswordFooter">
                <button class="btn btn-success" type="button" id="savePasswordBtn" onclick="postRequest()" data-toggle='modal' data-target='#passwordModal'>Update Password</button>
            </div>
        </div>
    </div>
</div>
</div>

<div class="link">
    <p1>Linked With Github</p1>
    <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" style=”width:40px;height:20px;" class="icon">  
</div>
<div class="link"> 
    <p2>Linked With Discord</p2>
    <img src="https://preview.redd.it/s9biyhs4lix61.jpg?auto=webp&s=c600a95eff95b3e9406a8b913c6aa3988b5e3a8b" style=”width:40px;height:20px;" class="icon">   
</div>

