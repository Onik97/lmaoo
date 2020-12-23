<?php
if ($userLoggedIn == null)
{
?>
<div class='welcomeMessage'>
    <h1>Welcome, Please log in</h1>
</div>
<div id='devInfo' class='container'>
    <div class='mx-5'>
        <h1>List of developer who worked on this Project</h1>
    </div>
    <div class='row align-items-start my-auto'>
        <div class='col-3 my-5'>
            <p>Section about Onik</p>
        </div>
        <div class='col-3 my-5'>
            <p>section about Lewis</p>
        </div>
        <div class='col-3 my-5'>
            <p>[section about Tufan]</p>
        </div>
        <div class='col-3 my-5'>
            <p>[section about Adil]</p>
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