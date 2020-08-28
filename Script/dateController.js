$(document).ready(function() 
{
  loadDates();
});

function tidyUpTimestamp(timestamp) 
{
    var dateCreated = new Date(timestamp);
    dateCreated.toString();
    var date = dateCreated.getDate();
    var month = dateCreated.getMonth();
    var year = dateCreated.getFullYear();
    // var time = dateCreated.getTime();
    var fullDate = `${date}/${month}/${year}`;
    return fullDate;
}

function loadDates()
{
  var ticketId = new URL(window.location.href).searchParams.get("ticketId");

  loadDatesFromServer(ticketId)
  .then(response => 
  {
    $("#createDate").html(tidyUpTimestamp(response.data[0].created));
    $("#updateDate").html(tidyUpTimestamp(response.data[0].updated));
  })
}