<link rel="stylesheet" type="text/css" href="/Style/managerPage.css"/>
<title>Manager</title>
<p id="navBarActive" hidden>managerPage</p>

<h1>Manager Dashboard</h1>

<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <h3 href="#">Projects <span id="projectSize" class="badge"></span></h3>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-success" data-toggle='modal' data-target='#globalModal' onclick="createProjectPrompt()">New Project</button>
        </div>
    </div>
    
    <!-- Projects List -->
    <hr><ul id="projectUl" class="list-group list-group-flush project-list"></ul>
</div>