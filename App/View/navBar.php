<?php use Lmaoo\Core\Render; ?>

<link rel="stylesheet" href="/Style/navbar.css">
<nav class="navbar navbar-expand-lg">

    <?php if(!isset($_COOKIE["lmaooDarkMode"])) $_COOKIE["lmaooDarkMode"] = 0; ?>
    <?php Render::loadDarkModeToggle($_COOKIE["lmaooDarkMode"], $_SESSION['userLoggedIn'] ?? null); ?>

    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="exampleNavComponents">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse w-100 order-3 dual-collapse2" id="navbarNav">
            <?php Render::SearchBar($_SESSION['userLoggedIn'] ?? null); ?>

            <ul class="nav navbar-nav ml-auto mr-5">

                <li class="nav-item"> <a class="nav-link" id="homeNav" href="/">Home</a> </li>
                <?php Render::ProjectsInNavBar($_SESSION['userLoggedIn'] ?? null); ?>

                <li class="nav-item dropdown">
                    <a id="accountNav" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account<span class="caret"></span></a>

                    <div class="dropdown-menu">
                        <?php Render::DropdownItems($_SESSION['userLoggedIn'] ?? null); ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- EDIT ACCOUNT MODAL -->
<div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="editAccountModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title modal-title-custom ml-9 mr-auto text-white" id="EditUserModalTitle">Account Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                
            <div class="modal-body">    
                <label>Upload Profile Picture</label>
                <div class="input-group my-2">
                    <div class="input-group-prepend">
                        <button class="input-group-text" id="uploadImageBtn" disabled >Upload</button>
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