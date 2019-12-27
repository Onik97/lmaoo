$(document).ready(function() 
{
  loadPeople(ticketId);
});

function People()
{
   document.getElementById("Modal-head").innerHTML = "People";
   document.getElementById("summernoteDiv").style.display = "none"
   document.getElementById("prompt").style.display = "block"
   document.getElementById("prompt").innerHTML = "Testing / Click here to assign to yourself";
   document.getElementById("Modal-footer").innerHTML = `
     <div class="modal-footer">
         <input class="btn btn-primary" type="submit" value="Save" onclick=savePeople(${ticketId},${userId})>
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

function saveAssigneeAsYourself(ticketId, name)
{
  console.log("Ticket ID is " + ticketId + " Your name is " + name);
}

function savePeople(ticketId, userId)
{
  console.log("The Ticket ID is " + ticketId + " with the userId who is logged in being " + userId);
  // You need to send 
  // function - peopleYourself
  // ticketId - ticketId
  // userId - userId
  // I have tested Back-end, it is working correctly
}