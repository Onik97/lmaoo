<?php
namespace Lmaoo\Core;

class Constant 
{
    // Database Columns
    public static array $USER_COLUMNS = ["userId", "username", "password", "forename", "surname", "level", "isActive", "picture", "github_id", "github_accessToken"];
    public static array $COMMENT_COLUMNS = ["commentId", "commentContent", "commentCreated", "ticketId", "userId"];
    public static array $FEATURE_COLUMNS = ["featureId", "name", "projectId", "active"];
    public static array $PROJECT_COLUMNS = ["projectId", "name", "status", "owner", "active"];
    public static array $PROJECTACCESS_COLUMNS = ["projectAccessId", "userId", "projectId", "allowAccess", "managerAccess"];
    public static array $TICKET_COLUMNS = ["ticketId", "summary", "featureId", "reporter_key", "assignee_key", "created", "updated", "progress", "deadline"];
}
