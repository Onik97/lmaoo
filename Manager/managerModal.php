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
                    <div class="search-input">
                        <a href="" target="_blank" hidden></a>
                        <input type="text" class="form-control" placeholder="User's name">
                        <div class="autocom-box">
                            <!-- here list are inserted from javascript -->
                        </div>
                        <div class="icon"><i class="fas fa-search"></i></div>
                    </div>
                </div>

                <!-- List of members on the platform  -->

                <ul class="list-group list-group-flush project-list">
                <li class="list-group-item">
                    <div class="project-info">User 1
                        <div class="owner-role">
                            <span class="user-access-role d-block">Owner</span>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ACTIVE ROLE?
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Manager</a>
                                <a class="dropdown-item" href="#">Developer</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="list-group-item justify-content-between">
                    <div class="project-info">User 2
                        <div class="manager-role">
                            <span class="user-access-role d-block">Manager</span>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ACTIVE ROLE?
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Manager</a>
                                <a class="dropdown-item" href="#">Developer</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            </div>

            <div class="modal-footer" id="managerModalFooter">
                <button type="button" class="btn btn-success">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>