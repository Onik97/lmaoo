<p id="navBarActive" hidden>adminPage</p>

<div class="container d-flex justify-content-center">
    <form class="form-inline my-2 my-lg-0">
        <input id="adminSearchBar" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    </form>
    <select id="adminSelect" class="form-control w-auto">
        <option value="" selected disabled>Select</option>
        <option value="true">Active</option>
        <option value="false">Inactive</option>
    </select>
</div>
<div class="container pt-4" id="adminContainer">
    <table class="table table-hover" id="admin-table">
        <tr>
            <th>Username</th>
            <th>Forename</th>
            <th>Surname</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
    </table>
</div>

<!-- ADMIN (EDIT USER) MODAL -->
<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title modal-title-custom ml-9 mr-auto text-black" id="adminModalTitle">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>

            <div id="adminModalHeader"></div>

            <div class="modal-body" id="adminModalBody">
                <div class="wrapper">
                    <label>Full name:</label>
                    <input id="adminFullname" class="search-input form-control" type="text" disabled>
                </div>
                <div class="wrapper">
                    <label>Username:</label>
                    <input id="adminUsername" class="search-input form-control" type="text" >
                </div>
                <div class="wrapper">
                    <label>User Level:</label>
                    <select id="userLevelSelect" class="form-control">
                        <option value="1">Junior Developer</option>
                        <option value="2">Senior Developer</option>
                        <option value="3">Product Owner</option>
                        <option value="4">Administrator</option>
				    </select>
                </div>
                <div class="wrapper">
                    <label id="activeUserToggle"></label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="adminUserToggle">
                        <label class="custom-control-label" for="adminUserToggle">User Activation Status</label>
                    </div>
                </div>
                <div class="wrapper">
                    <button id="resetAdminPassword" type="button" class="btn btn-primary btn-block">Reset password</button>
                    <small id="passwordMessage" class="form-text text-muted"></small>
                </div>
                
            </div>

            <div class="modal-footer" id="adminModalFooter">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveAdminBtn">Save changes</button>
            </div>

        </div>
    </div>
</div>