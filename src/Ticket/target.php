<?php include_once(__DIR__ . "/../../includes/autoloader.inc.php");

$ticketController = new TicketController();
$function = $_POST['function'];

if ($function == "checkTicket")
{
    Validator::validateDeveloper();
    echo $ticketController->ticketIdExistance($_POST['ticketId']);
}
else if ($function == "checkTicketExistance")
{
    Validator::validateDeveloper();
    echo $ticketController->ticketExistance($_POST['ticketName'], $_POST['featureId']);
}
else if ($function == "createComment")
{
    Validator::validateDeveloper();
    $ticketController->createComment($_POST['commentContent'], $_POST['ticketId'], $_POST['userId']);
}
else if ($function == "loadComments")
{
    Validator::validateDeveloper();
    echo json_encode($ticketController->loadComments($_POST['ticketId']));
}
else if ($function == "updateComment")
{
    Validator::validateDeveloper();
    echo $ticketController->updateComment($_POST['commentId'], $_POST['commentContent']);
}
else if ($function == "deleteComment")
{
    Validator::validateDeveloper();
    echo $ticketController->deleteComment($_POST['commentId']);
}
else if ($function == "saveSelectedAssignee")
{
    Validator::validateDeveloper();
    echo $ticketController->saveSelectedAssignee($_POST['ticketId'], $_POST['assigneeId']);
}
else if ($function == "assigneeSelf")
{
    Validator::validateDeveloper();
    echo $ticketController->assigneeYourself($_POST['ticketId'], $_POST['selfId']);
}
else if ($function == "loadDates")
{
    Validator::validateDeveloper();
    echo json_encode($ticketController->loadDates($_POST['ticketId']));
}
else if ($function == "loadAssignee")
{
    Validator::validateDeveloper();
    echo json_encode($ticketController->loadAssignee($_POST["ticketId"]));
}
else if ($function == "loadReporter")
{
    Validator::validateDeveloper();
    echo json_encode($ticketController->loadReporter($_POST['ticketId']));
}
else if ($function == "updateTicketTime")
{
    Validator::validateDeveloper();
    $ticketController->updateTicketTime($_POST["ticketId"]);
}
else if($function == "loadSummary")
{
    Validator::validateDeveloper();
    echo $ticketController->loadSummary($_POST['ticketId']);
}
else if ($function == "loadProgress")
{
    Validator::validateDeveloper();
    echo $ticketController->loadProgress($_POST['ticketId']);
}
else if ($function == "changeProgress")
{
    Validator::validateDeveloper();
    echo $ticketController->changeProgress($_POST['progress'], $_POST['ticketId']);
}
else 
{
    Library::notFoundMessage();
}