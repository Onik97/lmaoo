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

<!-- ADMIN MODAL -->
<div class="modal fade" id="admin-modal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title modal-title-custom ml-9 mr-auto text-white" id="admin-modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>

            <div id="admin-modal-header"></div>

            <div class="modal-body" id="admin-modal-body"></div>

            <div class="modal-footer" id="admin-modal-footer"></div>

        </div>
    </div>
</div>