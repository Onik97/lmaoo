<?php include_once(__DIR__ . "/../../includes/autoloader.inc.php");

try
{
    if (!Validator::validateUserLoggedIn()) return http_response_code(401); 
    RouteController::Post("checkTicket", Validator::validateDeveloper(), 'TicketController::ticketIdExistance', [@$_POST["ticketId"]]);
    RouteController::Post("checkTicketExistance", Validator::validateDeveloper(), 'TicketController::ticketExistance', [@$_POST['ticketName'], @$_POST['featureId']]);
    RouteController::Post("createComment", Validator::validateDeveloper(), 'TicketController::createComment', [@$_POST['commentContent'], @$_POST['ticketId'], @$_POST['userId']]);
    RouteController::Post("loadComments", Validator::validateDeveloper(), 'TicketController::loadComments', [@$_POST["ticketId"]]);
    RouteController::Post("updateComment", Validator::validateDeveloper(), 'TicketController::updateComment', [@$_POST['commentId'], @$_POST['commentContent']]);
    RouteController::Post("deleteComment", Validator::validateDeveloper(), 'TicketController::deleteComment', [@$_POST["commentId"]]);
    RouteController::Post("saveSelectedAssignee", Validator::validateDeveloper(), 'TicketController::saveSelectedAssignee', [@$_POST["ticketId"], @$_POST['assigneeId']]);
    RouteController::Post("assigneeSelf", Validator::validateDeveloper(), 'TicketController::assigneeYourself', [@$_POST["ticketId"], @$_POST['selfId']]);
    RouteController::Post("loadAssignee", Validator::validateDeveloper(), 'TicketController::loadAssignee', [@$_POST["ticketId"]]);
    RouteController::Post("loadReporter", Validator::validateDeveloper(), 'TicketController::loadReporter', [@$_POST["ticketId"]]);
    RouteController::Post("updateTicketTime", Validator::validateDeveloper(), 'TicketController::updateTicketTime', [@$_POST["ticketId"]]);
    RouteController::Post("loadSummary", Validator::validateDeveloper(), 'TicketController::loadSummary', [@$_POST["ticketId"]]);
    RouteController::Post("loadProgress", Validator::validateDeveloper(), 'TicketController::loadProgress', [@$_POST["ticketId"]]);
    RouteController::Post("changeProgress", Validator::validateDeveloper(), 'TicketController::changeProgress', [@$_POST['progress'], @$_POST["ticketId"]]);
    RouteController::Post("saveSummary", Validator::validateDeveloper(), 'TicketController::saveSummary', [@$_POST['summary'], @$_POST["ticketId"]]);
    Validator::ThrowNotFound();
}
catch(Throwable $e)
{
    http_response_code(500);
}