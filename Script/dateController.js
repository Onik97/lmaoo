$(document).ready(function() 
{
  loadDates();
});

function addZero(i)
{
  if (i < 10) { i = "0" + i; } return i; 
}

function tidyUpTimestamp(timestamp) 
{
    var dateCreated = new Date(timestamp);
    dateCreated.toString();
    var date = dateCreated.getDate();
    var month = dateCreated.getMonth();
    var year = dateCreated.getFullYear();
    var hours = dateCreated.getHours();
    var minutes = addZero(dateCreated.getMinutes());
    var ampm = (hours >= 12) ? "PM" : "AM";
    // var seconds = addZero(dateCreated.getSeconds());

    var fullDate = `${date}/${month}/${year} ${hours}:${minutes} ${ampm}`;
    return fullDate;
    
}

function loadDates()
{
  var ticketId = new URL(window.location.href).searchParams.get("ticketId");

  loadDatesFromServer(ticketId)
  .then(response => 
  {
    $("#createDate").html(tidyUpTimestamp(response.data[0].created.toLocaleString('en-GB')));
    $("#updateDate").html(tidyUpTimestamp(response.data[0].updated.toLocaleString('en-GB')));
  })
}