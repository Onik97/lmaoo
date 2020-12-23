<?php
if ($userLoggedIn == null)
{
?>
<div class="jumbotron jumbotron-fluid text-center">
  <div class="container">
    <h1 class="display-4">Hard stuck Gold dps ;-;</h1>
  </div>
</div>

<div class='text-center'>
        <h1>List of developer who worked on this Project</h1>
</div>

<div id='devInfo' class='container'>
    <div id="homePageCards" class="card-deck">
        <div class="card">
        <img class="card-img-top" src="../Images/LewisProfile.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Lewis</h5>
                <p class="card-text">Still hardstuck gold dps, i cri everytime.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Joined project 1 year ago</small>
            </div>
        </div>
        <div class="card">
        <img class="card-img-top" src="../Images/AvatarImage.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Adil</h5>
                <p class="card-text">King Of Heroes</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Joined project 1 year ago</small>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="../Images/AvatarImage.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Onik</h5>
                <p class="card-text">Also hardstuck gold dps.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Started project 1 year ago</small>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="../Images/AvatarImage.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Tufan</h5>
                <p class="card-text">UX Genius</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Joined project 1 year ago</small>
            </div>
        </div>
    </div>
</div>
<?php
}
else 
{
?>
<h1 class='welcomeMessage'>Welcome back Lewis</h1>
<table id='homeTicketTable' class='table'>
    <thead>
        <tr>
            <th class='col4'>Ticket ID</th>
            <th class='col4'>Summary</th>
            <th class='col4'>Progress</th>
            <th class='col4'>Date Created</th>
        </tr>
    </thead>
</table>
<?php
}
?>