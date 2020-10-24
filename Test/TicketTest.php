<?php
require __DIR__ . "/../Ticket/ticketController.php";
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{
    public function test_helloWorld()
    {
        $this->assertEquals("lol", "lol");
    }
}