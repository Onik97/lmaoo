$(document).ready(function() 
{
    loadAssignee();
    loadReporter();
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
  loadUsersInAssigneeModal();
  document.getElementById("Modal-footer").innerHTML = `
    <div class="modal-footer">
        <input class="btn btn-primary" type="submit" value="Save" onclick=savePeople(${ticketId})>
    </div>
    `;
}

function loadAssignee()
{
  var url = new URL(window.location.href);
  ticketId = url.searchParams.get("ticketId");
  loadAssigneeFromServer(ticketId)
  .then(response => 
    {
        var res = response.data;
        $("#assignee").html(res[0].forename + " " + res[0].surname);
        $("#assigneeUserId").html(res[0].userId);
    })
}

function loadReporter()
{
  var url = new URL(window.location.href);
  ticketId = url.searchParams.get("ticketId");
  loadReporterFromServer(ticketId)
  .then(response => 
    {
        var res = response.data;
        $("#reporter").html(res[0].forename + " " + res[0].surname);
        $("#reporterUserId").html(res[0].userId);
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

function loadUsersInAssigneeModal()
{
  var assigneeUserId = document.getElementById("assigneeUserId").innerHTML;
  var selectUsers = document.getElementById("selectUsers");

  getActiveUsersFromServer()
  .then((response) => 
  {
    var usersJson = response.data;
    for (let i = 0; i < usersJson.length; i++)
    {
      if (usersJson[i].userId == assigneeUserId)
      {
        $("#selectUsers")
        .prepend("<option value="+ usersJson[i].userId +" disabled selected>" + usersJson[i].forename + " " + usersJson[i].surname + "</option>");
      }
      else 
      {
        var option = document.createElement('option');
        option.text = usersJson[i].forename + " " + usersJson[i].surname;
        option.value = usersJson[i].userId;
        selectUsers.add(option);
      }
    }
  })
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