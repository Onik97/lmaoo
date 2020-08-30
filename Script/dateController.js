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
    var hours = dateCreated.getHours();
    var minutes = (dateCreated.getMinutes() < 10) ? ("0" + dateCreated.getMinutes()) : dateCreated.getMinutes(); // to add 0 from 0-9 minutes
    var ampm = (hours >= 12) ? "PM" : "AM";

    var fullDate = `${date}/${month}/${year} ${hours}:${minutes} ${ampm}`;
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