$(document).ready(function() 
{
  loadPeople(ticketId);
});

function People()
{
  var assignee = document.getElementById("assignee").innerHTML;
   document.getElementById("Modal-head").innerHTML = "People";
   document.getElementById("prompt").style.display = "block"
   document.getElementById("prompt").innerHTML = 
   `
   <p>Select Assignee below</p>
   <select id="selectUsers">
   <option value="" disabled selected>${assignee}</option>
   </select>
   `;
   loadUsersAsSelect();
   document.getElementById("Modal-footer").innerHTML = `
     <div class="modal-footer">
         <input class="btn btn-primary" type="submit" value="Save" onclick=savePeople(${ticketId})>
     </div>
     `;
}

function loadPeople(ticketId)
{
    var data = new FormData();
    data.append('function', "loadPeople");
    data.append('ticketId', ticketId);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ticketController.php', true);
    xhr.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200)
        {
          var response = JSON.parse(this.responseText)[0];
          $("#reporter").html(response.reporter);
          $("#assignee").html(response.assignee);
        }
    }
    xhr.send(data);
}

function savePeople(ticketId)
{
  var selectElement = document.getElementById("selectUsers");
  var selectedUser = selectElement.options[selectElement.selectedIndex].text;

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
        loadPeople(ticketId);
        $('#CommentModal').modal('hide'); // Shouldnt we use a different Modal? Should we just rename it to ticketModal? I will leave that decision to you Lewis
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
          option.value = users[i].username;
          if (users[i].forename + " " + users[i].surname == assignee) {}
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
		  loadPeople(ticketId);
	  }
  }
  xhr.send(data);
}

