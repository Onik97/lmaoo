function editUser(userId)
{
    document.getElementById("modalTitle").innerHTML = "Editing User";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "adminController.php?userId="+userId, true)
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var userStuff = JSON.parse(this.responseText);
            document.getElementById("modalTitle").innerHTML = "Editing User";
            document.getElementById("modalContent").innerHTML = `
            <form action="../User/adminController.php" method="POST">
            <div class="modal-body">
            <div class="form-group">
                 <label>User ID</label>
                 <input class="form-control" value=${userStuff.userId} name="userId" readonly>
             </div>
             <div class="form-group">
                 <label>Forename</label>
                 <input class="form-control" value=${userStuff.forename} name="editForename" >
             </div>
             <div class="form-group">
                 <label>Surname</label>
                 <input class="form-control" value=${userStuff.surname}  name="editSurname">
             </div>
             <div class="form-group">
                 <label>Username</label>
                 <input class="form-control" value=${userStuff.username} name="editUsername">
             </div>
             <div class="form-group">
             <label>Level</label> <br>
             <select class="form-control" name="userSelect" required>
             <option value="0" selected disabled></option>
             <option value="1">Standard</option>
             <option value="2">Ticket Manager</option>
             <option value="3">Admin</option>
             <option value="4">Super User</option>
             </select>
             </div>
             </div>
             <input type="hidden" name="function" value="adminUpdate">
          <div class="modal-footer">
          <input class="btn btn-primary" type="submit" value="Save Changes">
         </div>
         </form>
            `;
        }
    }
}

function deactivateUser(userId)
{
    document.getElementById("modalTitle").innerHTML = "Deactivating User";
    document.getElementById("modalContent").innerHTML = 
    `
    <form action="../User/adminController.php" method="POST">
    <div class="modal-body">
    
    <div class="form-group">
        <label>User ID</label>
        <input class="form-control" value=${userId} name="userId" readonly>
    </div>
    
    <input type="hidden" name="function" value="deactivateUser">
    
    <div class="modal-footer">
        <input class="btn btn-primary" type="submit" value="Deactivate">
    </div>
    `
}