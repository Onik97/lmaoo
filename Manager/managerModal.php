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
                    <div class="autocom-box">
                        <!-- here list are inserted from javascript -->
                        <li>Static</li>
                        <li>Data</li>
                        <li>for</li>
                        <li>Tufan</li>
                    </div>
                </div>

                <!-- List of members on the platform  -->

                <ul class="list-group list-group-flush user-list">
                    <li class="list-group-item users">
                        <div class="user-info">
                            <span id="tufan">Static Data for Tufan 1</span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">ACTIVE ROLE?</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" value="1">Manager</a>
                                    <a class="dropdown-item" value="0">Developer</a>
                                </div>
                            </div>
                        </div>
                        <i class="fas fa-times"></i>
                    </li>

                    <li class="list-group-item users">
                        <div class="user-info">
                            <span id="tufan">Static Data for Tufan 2</span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">ACTIVE ROLE?</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" value="1">Manager</a>
                                    <a class="dropdown-item" value="0">Developer</a>
                                </div>
                            </div>
                        </div>
                        <i class="fas fa-times"></i>
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