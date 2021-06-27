  <title>Home</title>
  <p id="navBarActive" hidden>projectPage</p>

  <div class="d-flex">
    <div id="projectDiv">
      <nav id="sidebar">
        <div id="sidebar-header" class="sidebar-header">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="featureToggle" checked>
            <label class="custom-control-label" for="featureToggle">
              <h1>Feature</h1>
            </label>
          </div>
        </div>

        <ul id="activeFeatures" class="list-unstyled components" style="display: none;">
          <?php Lmaoo\Core\Render::Features("1"); ?>
        </ul>

        <div id="#featureModalWrapper">
          <div id="featureModal" data-toggle="modal" data-target="#createFeatureModal">Create Feature</div>
        </div>

        <ul id="inactiveFeatures" class="list-unstyled components" style="display: none;">
          <?php Lmaoo\Core\Render::Features("0"); ?>
        </ul>

      </nav>
    </div>

    <div id="createProject"></div>

    <div class="content">
      <div class="row">
        <div class="col-sm-9">
          <h1 id="ticketMessage">Tickets</h1>
        </div>
        <div class="col-sm-3" id="ticketButtonDiv">
          <button type="button" id="createTicketButton" data-toggle="modal" data-target="#createTicketModal" class="btn btn-success">Create Ticket</button>
        </div>
      </div>

      <p id="selectedFeatureId" hidden>0</p>
      <div id="ticketDiv">

        <ul class="nav nav-tabs nav-fill" id="projectProgressTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="open-tab" data-toggle="tab" href="#open-content" role="tab">Open</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="progress-tab" data-toggle="tab" href="#progress-content" role="tab">In Progress</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="complete-tab" data-toggle="tab" href="#complete-content" role="tab">Complete</a>
          </li>
        </ul>

        <table id="ticketTable" class="table">
          <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-home-tab">
            <thead>
              <tr>
                <th class="col1" scope="col">Ticket ID</th>
                <th class="col2" scope="col">Summary</th>
                <th class="col3" scope="col">Progress</th>
                <th class="col4" scope="col">Assignee</th>
              </tr>
            </thead>
        </table>

        <div id="ticketBtnDiv"></div>
      </div>
    </div>
  </div>

  <!-- CREATE TICKET MODAL -->
  <div class="modal fade" id="createTicketModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title modal-title-custom ml-9 mr-auto" id="createTicketHead">Create Ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="createTicketBody">
          <div class="wrapper">
            <label>Ticket name:</label>
            <input type="text" class="search-input form-control" id="ticketName" onkeyup="projectValidation()">
          </div>
        </div>

        <div class="modal-footer" id="createTicketFooter">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Save changes</button>
        </div>

      </div>
    </div>
  </div>

  <!-- CREATE FEATURE MODAL -->
  <div class="modal fade" id="createFeatureModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title modal-title-custom ml-9 mr-auto text-black" id="createFeatureHead">Create Feature</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="createFeatureBody">
          <div class="wrapper">
            <label>Feature name:</label>
            <input type="text" class="search-input form-control" id="featureName" onkeyup="projectValidation()">
          </div>
        </div>

        <div class="modal-footer" id="createFeatureFooter">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- EDIT FEATURE MODAL -->
  <div class="modal fade" id="editFeatureModal" tabindex="-1" role="dialog" aria-labelledby="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title modal-title-custom ml-9 mr-auto text-black" id="editFeatureHead">Edit Feature</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="editFeatureBody">
          <div class="wrapper">
            <label>New feature name:</label>
            <input type="text" class="search-input form-control" id="newFeatureName" onkeyup="projectValidation()">
          </div>
          <div class="wrapper">
            <small id="passwordHelpBlock" class="form-text text-muted">Feature limit exceeded (limit number)</small>
          </div>
          <div class="wrapper">
            <label id="activeUserToggle"></label>
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="editFeatureToggle">
              <label class="custom-control-label" for="editFeatureToggle">Toggle to activate feature</label>
            </div>
          </div>
        </div>

        <div class="modal-footer" id="editFeatureFooter">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Save changes</button>
        </div>
      </div>
    </div>
  </div>