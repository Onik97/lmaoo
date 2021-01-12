<?php
if ($function == "loadTicketsWithDeadline")
{
    Validator::validateDeveloper();
    echo json_encode($homeController->loadTicketsWithDeadline());
}
else if ($function == "loadOwnProjects")
{
    Validator::validateDeveloper();
    echo json_encode($homeController->loadOwnProjects());
}
else 
{
    Library::notFoundMessage();
}