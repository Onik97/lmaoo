$(document).ready(function() 
{
    loadAssignee();
    loadReporter();
});

function peoplePrompt()
{
  document.getElementById("Modal-head").innerHTML = "Select Assignee";
  document.getElementById("modal-body").innerHTML = ""; // Makes it empty first to avoid multiple append childs
  
  let modalBody = document.querySelector("#modal-body");
  let selectUsers = document.createElement("select");
  selectUsers.setAttribute("id", "selectUsers");
  modalBody.appendChild(selectUsers);
  
  loadUsersInAssigneeModal();

  let modalFooter = document.querySelector("#modal-footer");
  document.getElementById("modal-footer").innerHTML = ""; // Makes it empty first to avoid multiple append childs
  let input = document.createElement("input");
  input.setAttribute("class", "btn btn-primary");
  input.setAttribute("type", "submit");
  input.setAttribute("value", "Save");
  input.setAttribute("onclick", "saveSelectedAssignee()");

  modalFooter.appendChild(input);
}

function loadAssignee()
{
  var ticketId = new URL(window.location.href).searchParams.get("ticketId");
  loadAssigneeFromServer(ticketId)
  .then(response => 
  {
    if (response.data.length == 0) return;

    var res = response.data;
    $("#assignee").html(`${res[0].forename} ${res[0].surname} (${res[0].username})`);
    $("#assigneeUserId").html(res[0].userId);
  })
}

function loadReporter()
{
  var ticketId = new URL(window.location.href).searchParams.get("ticketId");
  loadReporterFromServer(ticketId)
  .then(response =>
  {
    var res = response.data;
    $("#reporter").html(`${res[0].forename} ${res[0].surname} (${res[0].username})`);
    $("#reporterUserId").html(res[0].userId);
  })
}

function saveSelectedAssignee()
{
  var ticketId = new URL(window.location.href).searchParams.get("ticketId");
  var assigneeId = document.getElementById("selectUsers").options[document.getElementById("selectUsers").selectedIndex].value;
  var assigneeName = document.getElementById("selectUsers").options[document.getElementById("selectUsers").selectedIndex].text;

  var data = new FormData();
  data.append('function', "saveSelectedAssignee");
  data.append('ticketId', ticketId);
  data.append('assigneeId', assigneeId);

  axios.post('../Ticket/ticketController.php', data)
  .then(() => 
    {
      loadAssignee();
      $('#ticketPageModal').modal('hide');
      overHang("success", "Ticket assigned to " + assigneeName);
      loadDates();
    })
}

function loadUsersInAssigneeModal()
{
  var assigneeUserId = document.getElementById("assigneeUserId").innerHTML;
  var selectUsers = document.getElementById("selectUsers");

  getActiveUsersFromServer()
  .then(response => 
  {
    var usersJson = response.data;
    for (let i = 0; i < usersJson.length; i++)
    {
      if (usersJson[i].userId == assigneeUserId) $("#selectUsers")
      .prepend(`<option value=${usersJson[i].userId} disabled selected> ${usersJson[i].forename} ${usersJson[i].surname} (${usersJson[i].username})</option>`);
      else if (usersJson[i].userId == userId);
      else 
      {
        var option = document.createElement('option');
        option.text = `${usersJson[i].forename} ${usersJson[i].surname} (${usersJson[i].username})`;
        option.value = usersJson[i].userId;
        selectUsers.add(option);
      }
    }
  })
}

function saveAssigneeAsYourself()
{
  var ticketId = new URL(window.location.href).searchParams.get("ticketId");

  var data = new FormData();
  data.append('function', "assigneeSelf");
  data.append('ticketId', ticketId)
  data.append('selfId', userId)
    
  axios.post('../Ticket/ticketController.php', data)
  .then(() => 
  {
    loadAssignee();
    $('#ticketPageModal').modal('hide');
    overHang("success", "Ticket assigned to yourself!");
    loadDates();
  })
}