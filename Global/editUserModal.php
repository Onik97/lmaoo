<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<a class="btn btn-default" data-toggle="modal" data-target="#view-modal">View</a>
<form action="../User/userController.php" method="POST">
            <!-- Modal -->
            <div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                   <div class="modal-body">
                        ...
                        <?php echo $_SESSION['userLoggedIn']->getForename(); ?>
                    </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                 </div>
            </div>
        </div>
</form>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>