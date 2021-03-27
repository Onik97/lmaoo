$(document).ready(() => { loadSummary(); loadProgress(); NavbarActivater.projectActiveTab(); })

function loadSummary()
{
    var ticketId = new URL(window.location.href).searchParams.get("ticketId");
    var data = new FormData();
    data.append('function', "loadSummary");
    data.append('ticketId', ticketId);

    axios.post('../Ticket/target.php', data).then((res) => $("#ticketSummaryHeader").html(res.data));
}

function loadProgress()
{
    var ticketId = new URL(window.location.href).searchParams.get("ticketId");
    var data = new FormData();
    data.append('function', "loadProgress");
    data.append('ticketId', ticketId);

    axios.post('../Ticket/target.php', data)
    .then((res) => 
    {
        $("#ticketProgress").html(res.data);
        switch(res.data)
        {
            case "Open": $("#changeProgressBtn").html("Change progress to 'In Progress'"); break;
            case "In Progress": $("#changeProgressBtn").html("Change progress to 'In Automation'"); break;
            case "In Automation": $("#changeProgressBtn").html("Change progress to 'Complete'"); break;
            case "Complete": $("#changeProgressBtn").html("Re-open ticket"); break;
        }
    });
}

function changeProgress()
{
    var ticketId = new URL(window.location.href).searchParams.get("ticketId");
    var currentProgress = $("#ticketProgress").html();
    var progress = "";

    switch(currentProgress)
    {
        case "Open": progress = "In Progress"; break;
        case "In Progress": progress = "In Automation"; break;
        case "In Automation": progress = "Complete"; break;
        case "Complete": progress = "Open"; break;
    }

    var data = new FormData();
    data.append("function", "changeProgress");
    data.append("ticketId", ticketId);
    data.append("progress", progress)

    axios.post('../Ticket/target.php', data)
    .then(()=> 
    { 
        overHang("success", `Status change to '${progress}' successfully!`); 
        loadProgress();
        loadDates();
    });
}

$("#ticketSummaryHeader").click(function() 
{
    $('#ticketSummaryHeader').summernote(
    {
        focus: true,
        toolbar: false,
        height: 50,
        popover:
        {
          image: [],
          link: [],
          air: [],
        }
    });
    $('.note-statusbar').hide(); // Hides adjustable height
    $('#ticketSummaryHeader').on('summernote.keydown', (we, e) => 
    {
        if(e.shiftKey && e.keyCode == 13) saveSummary(e, "#ticketSummaryHeader");
        else if(e.keyCode == 13) e.preventDefault(); // Prevents new line to be made
    })
});

function saveSummary(e, summarySummerNote)
{
    var summary = $(summarySummerNote).summernote('code');
    var summaryStripped = summary.replace(/<[^>]*>?/gm, "");
    var ticketId = new URL(window.location.href).searchParams.get("ticketId");

    if ($(summarySummerNote).summernote("isEmpty") || summaryStripped.trim().length == 0)
    {
      overHang("error", "Summary must be entered!"); e.preventDefault();
    }
    else if (summary.length > 30)
    {
      overHang("error", "Summary too large!"); e.preventDefault();
    }
    else 
    {
        e.preventDefault();
        var data = new FormData();
        data.append("function", "saveSummary");
        data.append("summary", summaryStripped.trim());
        data.append("ticketId", ticketId);

        axios.post("../Ticket/target.php", data)
        .then(() =>
        {
            overHang("success", "Summary has been saved");
            $(summarySummerNote).summernote("destroy");
        })
    }
}