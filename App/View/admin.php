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
            <th>User ID</th>
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
                    <input type="text" class="search-input form-control" id="adminFullname" placeholder="Full name" onkeyup="projectValidation()" disabled>
                </div>
                <div class="wrapper">
                    <label id="adminUsernameHeader">Username:</label>
                    <input type="text" class="search-input form-control" id="adminUsername" placeholder="User name" onkeyup="projectValidation()" disabled>
                </div>
                <div class="wrapper">
                    <label id="activeUserToggle"></label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="adminUserToggle">
                        <label class="custom-control-label" for="adminUserToggle">Toggle to activate user</label>
                    </div>
                </div>
                <div class="wrapper">
                    <button id="resetAdminPassword" type="button" class="btn btn-primary btn-block">Reset password</button>
                    <small id="passwordHelpBlock" class="form-text text-muted">Feature limit exceeded (limit number)</small>
                </div>

            </div>

            <div class="modal-footer" id="adminModalFooter">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveButton">Save changes</button>
            </div>

        </div>
    </div>
</div>