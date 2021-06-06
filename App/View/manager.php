<title>Manager</title>
<p id="navBarActive" hidden>managerPage</p>

<h1>Manager Dashboard</h1>

<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <h3 href="#">Projects <span id="projectSize" class="badge"></span></h3>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-success" data-toggle='modal' data-target='#managerModal' onclick="createProjectPrompt()">New Project</button>
        </div>
    </div>
    
    <!-- Projects List -->
    <hr><ul id="projectUl" class="list-group list-group-flush project-list"></ul>
</div>

<!-- MODAL -->
<div class="modal fade" id="managerModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title modal-title-custom ml-9 mr-auto text-black" id="managerModalHead">Choose Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Search bar to look for members on the platform -->
            <div class="modal-body" id="managerModalBody">
                <div class="wrapper">
                    <input type="text" class="search-input form-control" placeholder="User's name">
                    <div class="autocom-box"><!-- here list are inserted from javascript --></div>
                </div>

                <!-- List of members on the platform  -->
                <ul class="list-group list-group-flush user-list"></ul>
            </div>

            <div class="modal-footer" id="managerModalFooter"></div>

        </div>
    </div>
</div>