<?php
namespace Lmaoo\Controller;

use Lmaoo\Model\Ticket;
use Lmaoo\Utility\APIResponse;
use Lmaoo\Utility\Validation;

class TicketController extends BaseController
{
    public function createTicket($json)
    {
        $data = json_decode($json, true); $validation = Validation::createTicket($data);
        $validation == null ? Ticket::create($data) : APIResponse::BadRequest($validation);
    }
}
