            <!-- Modal -->
            <div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Account Details</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                   <div class="modal-body">
                   <form action="../User/userController.php" method="POST">
                    <div class="form-group">
                        <label>Forename</label>
                        <input class="form-control" value=<?php echo $userLoggedIn->getId();?> readonly>
                    </div>
                    <div class="form-group">
                        <label>Forename</label>
                        <input class="form-control" value=<?php echo $userLoggedIn->getForename(); ?> >
                    </div>
                    <div class="form-group">
                        <label>Surname</label>
                        <input class="form-control" value=<?php echo $userLoggedIn->getSurname(); ?> >
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" value=<?php echo $userLoggedIn->getUsername(); ?> >
                    </div>
                    </form>
                    </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                 </div>
            </div>
        </div>