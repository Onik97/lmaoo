<p id="navBarActive" hidden>adminPage</p>
<link rel="stylesheet" href="../Css/admin.css">

<div class="container d-flex justify-content-center">
    <form class="form-inline my-2 my-lg-0">
        <input id="adminSearchBar" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    </form>
    <select id="adminSelect" class="form-control w-auto" onchange="activeSelect(this.value)">
        <option value="Active">Active</option>
        <option value="inActive">In-Active</option>
    </select>
</div>
<div class="container pt-4" id="adminContainer">
    <table class="table table-hover" id="admin-table">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Forename</th>
            <th>Surname</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
    </table>
</div>