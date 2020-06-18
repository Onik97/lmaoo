$(document).ready(function() 
{
  loadDates();
});

function loadDates()
{
  var ticketId = new URL(window.location.href).searchParams.get("ticketId");

  loadDatesFromServer(ticketId)
  .then(response => 
  {
    $("#createDate").html(response.data[0].created);
    $("#updateDate").html(response.data[0].updated);
  })
}