$(document).ready(function() 
{
  loadDates(ticketId);
});

function loadDates(ticketId)
{
    var data = new FormData();
    data.append('function', "loadDates");
    data.append('ticketId', ticketId);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ticketController.php', true);
    xhr.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200)
        {
          var response = JSON.parse(this.responseText)[0];
          $("#createDate").html(response.created);
          $("#updateDate").html(response.updated);
        }
    }
    xhr.send(data);
}