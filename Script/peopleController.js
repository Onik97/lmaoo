$(document).ready(function() 
{
  loadPeople(ticketId);
});

function People()
{
  document.getElementById("Modal-head").innerHTML = "People";
  document.getElementById("prompt").style.display = "block"
  document.getElementById("prompt").innerHTML = 
  `
  <p>Select Assignee below</p>
  <select id="selectUsers">
  </select>
  `;
  loadUsersAsSelect();
  document.getElementById("Modal-footer").innerHTML = `
    <div class="modal-footer">
        <input class="btn btn-primary" type="submit" value="Save" onclick=savePeople(${ticketId})>
    </div>
    `;
}

function loadUsers()
{
  loadUsersFromServer()
  .then(response => 
    {
      console.log(response.data);
    })
}

function loadPeople(ticketId)
{
  loadPeopleFromServer(ticketId)
  .then(response => 
    {
      var res = response.data;
      $("#reporter").html(res[0].reporter);
      $("#assignee").html(res[0].assignee);
    })
}

function savePeople(ticketId)
{
  var selectElement = document.getElementById("selectUsers");
  var selectedUser = selectElement.options[selectElement.selectedIndex].text;
  var selectedUserValue = selectElement.options[selectElement.selectedIndex].value;  

  var data = new FormData();
  data.append('function', "savePeople");
  data.append('ticketId', ticketId);
  data.append('newAssignee', selectedUser);

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'ticketController.php', true);
  xhr.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
      {
        console.log(this.responseText);
        saveAssigneeKey(selectedUserValue, ticketId);
        loadPeople(ticketId);
        $('#CommentModal').modal('hide'); // Shouldnt we use a different Modal? Should we just rename it to ticketModal? I will leave that decision to you Lewis
        overHang("success", "Ticket assigned to "+ selectedUser);
      }
  }
  xhr.send(data);
}

function loadUsersAsSelect()
{
  var assignee = document.getElementById("assignee").innerHTML;
  var selectUsers = document.getElementById("selectUsers");
  var data = new FormData();
  data.append('function', "loadUsers");

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'ticketController.php', true);
  xhr.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
      {
        var users = JSON.parse(this.responseText);
        for (let i = 0; i < users.length; i++) 
        {
          option = document.createElement('option');
          option.text = users[i].forename + " " + users[i].surname;
          option.value = users[i].userId;
          if (users[i].forename + " " + users[i].surname == assignee) 
          {
            $("#selectUsers").prepend("<option value="+ users[i].userId +" disabled selected>" + users[i].forename + " " + users[i].surname + "</option>");
            // selectUsers.add(option); $(option).prop("selected", true); $(option).prop("disabled", true);
          }
          else 
          { 
            selectUsers.add(option); 
          }
        }
      }
  }
  xhr.send(data);
}

function saveAssigneeAsYourself(ticketId, fullName)
{
  var data = new FormData();
  data.append('function', "peopleYourself");
  data.append('ticketId', ticketId)
  data.append('fullName', fullName)
  
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'ticketController.php', true);
  xhr.onreadystatechange = function()
  {
	  if (this.readyState == 4 && this.status == 200)
	  {
      console.log(this.responseText);
      saveAssigneeKey(userId, ticketId);
      loadPeople(ticketId);
      overHang("success", "Ticket assigned to yourself!");
	  }
  }
  xhr.send(data);
}