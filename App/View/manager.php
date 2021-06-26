<title>Manager</title>
<p id="navBarActive" hidden>managerPage</p>

<h1>Manager Dashboard</h1>

<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <h3 href="#">Projects <span id="projectSize" class="badge"></span></h3>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-success" data-toggle='modal' data-target='#createProjectModal' onclick="createProjectPrompt()">New Project</button>
        </div>
    </div>

    <!-- Projects List -->
    <hr>
    <ul id="projectUl" class="list-group list-group-flush project-list">
        <?php Lmaoo\Core\Render::Projects(); ?>
    </ul>
</div>

<!-- CREATE NEW PROJECT MODAL -->
<div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title modal-title-custom ml-9 mr-auto text-black" id="createProjectHead">Create Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="createProjectBody">
                <div class="wrapper">
                    <label>Project name:</label>
                    <input type="text" class="search-input form-control" id="projectName" placeholder="Project name" onkeyup="projectValidation()">
                    <div class="autocom-box">
                        <!-- here list are inserted from javascript -->
                    </div>
                </div>
                <div class="wrapper">
                    <label>Status:</label>
                    <select id="projectStatus" class="form-control" onchange="projectValidation()" required="">
                        <option value="0" disabled=""></option>
                        <option value="Back-log">Back-log</option>
                        <option value="Development">Development</option>
                        <option value="QA">QA</option>
                        <option value="Releasing">Releasing</option>
                        <option value="Released">Released</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer" id="createProjectFooter">
                <button class="btn btn-success" type="button" id="saveProjectBtn" onclick="postRequest()" data-toggle='modal' data-target='#managerModal'>Save Project</button>
                <!-- <button type="button" class="btn btn-success" data-toggle='modal' data-target='#managerModal' onclick="postRequest()">Save</button> -->
            </div>

        </div>
    </div>
</div>

<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-title-custom ml-9 mr-auto text-black" id="editProjectHead">Edit Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editFeatureBody">
                <div class="wrapper">
                    <label>New project name:</label>
                    <input type="text" class="search-input form-control" id="projectName" placeholder="Project name" onkeyup="projectValidation()">
                </div>
                <div class="wrapper">
                    <small id="passwordHelpBlock" class="form-text text-muted">Project limit exceeded (limit number)</small>
                </div>
                <!-- Search bar to look for members on the platform -->
                <div class="wrapper">
                    <input type="text" class="search-input form-control" placeholder="User's name">
                    <div class="autocom-box">
                        <!-- here list are inserted from javascript -->
                    </div>
                </div>
                <!-- List of members on the platform  -->
                <ul class="list-group list-group-flush user-list"></ul>
            </div>

            <div class="modal-footer" id="editProjectFooter">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>