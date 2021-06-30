<?php
namespace Lmaoo\Controller;

use Lmaoo\Core\Constant;
use Lmaoo\Model\Comment;
use Lmaoo\Model\Ticket;
use Lmaoo\Utility\APIResponse;
use Lmaoo\Utility\Validation;

class TicketController extends BaseController
{
    public function createTicket($json)
    {
        $data = json_decode($json, true); $data["reporter_key"] = $this->userLoggedIn->userId;
        $validation = Validation::createTicket($data);
        
        $validation == null ? Ticket::create($data) : APIResponse::BadRequest($validation);
    }

    public function createComment($json)
    {
        $data = json_decode($json, true); $data["userId"] = $this->userLoggedIn->userId;
        $validation = Validation::createComment($data);

        $validation == null ? Comment::create($data) : APIResponse::BadRequest($validation);
    }

    public function updateComment($json)
    {
        $data = json_decode($json, true); $data["userId"] = $this->userLoggedIn->userId;
        $validation = Validation::updateComment($data);
        if ($data["commentId"] ?? null != null) $commentId = $data["commentId"]; unset($data["commentId"]);
        $validation == null ? Comment::update($commentId, $data) : APIResponse::BadRequest($validation);
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::read(Constant::$COMMENT_COLUMNS, ["commentId" => $commentId])[0];
        if ($comment->userId != $this->userLoggedIn->userId) return APIResponse::Forbidden("You do not have rights to do this action");
        Comment::delete($commentId);
    }
}
