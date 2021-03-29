<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editFeatureModal">
Edit feature modal test
</button>

<div class="modal fade" id="editFeatureModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title modal-title-custom ml-9 mr-auto text-white" id="featureModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-head" id="featureModalHead">
            </div>

            <div class="modal-body" id="featureModalBody">
                <form>
                    <div class="form-group">
                        <label>Edit feature name: </label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class='custom-control custom-switch'>
                        <label class='custom-control-label'>Active</label>
                        <input type='checkbox' class='custom-control-input'>
                    </div>
                </form>
            </div>

            <div class="modal-footer" id="featureModalFooter">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div> 