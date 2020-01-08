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
             <option value="" selected disabled></option>
             <option value="1">Standard</option>
             <option value="2">Admin</option>
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

function deleteUser(userId)
{
    document.getElementById("modalTitle").innerHTML = "Deleting User";
    document.getElementById("modalContent").innerHTML = "Are you sure?";
    console.log("Your ID is " + userId);
}

function viewUser(userId)
{
    document.getElementById("modalTitle").innerHTML = "Viewing User";
    console.log("Your ID is " + userId);
}

