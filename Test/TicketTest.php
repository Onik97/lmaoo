<?php
require __DIR__ . "/../Ticket/ticketController.php";
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{
    public function test_ticketIdExistance_null()
    {
        $ticketController = new ticketController();
        $expected = $ticketController->ticketIdExistance(null);
        $this->assertEquals($expected, null);
    }

    public function test_ticketIdExistance_false()
    {
        $ticketController = new ticketController();
        $expected = $ticketController->ticketIdExistance(-1);
        $this->assertEquals($expected, null);
    }

    public function test_ticketIdExistance_true()
    {
        $ticketController = new ticketController();
        $expected = $ticketController->ticketIdExistance(83);
        $this->assertEquals($expected, true);
    }
    
    public function test_ticketExistance_null()
    {
        $ticketController = new ticketController();
        $expected = $ticketController->ticketExistance(null, null);
        $this->assertEquals($expected, null);
    }

    public function test_ticketExistance_incorrectFormat()
    {
        $ticketController = new ticketController();
        $expected = $ticketController->ticketExistance(1,"featureId");
        $this->assertEquals($expected, null);
    }
    
    /** @test */
    public function test_ticketExistance_true()
    {
        $ticketController = new ticketController();
        $expected = $ticketController->ticketExistance("AutomationOpenTicket", 9);
        $this->assertTrue($expected);
    }

    public function test_ticketExistance_falseTicketName()
    {
        $ticketController = new ticketController();
        $expected = $ticketController->ticketExistance("ThisTicketDoesNotExist", 9);
        $this->assertFalse($expected);
    }

    public function test_ticketExistance_falseFeatureId()
    {
        $ticketController = new ticketController();
        $expected = $ticketController->ticketExistance("AutomationOpenTicket", -1);
        $this->assertEquals($expected, false);
    }

    /** @test */
    public function test_loadComments_checkContents()
    {
        $ticketController = new ticketController();
        $comments = $ticketController->loadComments(83);
        
        foreach ($comments as $comment) 
        {
            if($comment->ticketId == 83)
            {
                $this->assertEquals($comment->commentContent, "<p>This comment will be unit tested!</p>");
                $this->assertEquals($comment->commentId, 254);
                $this->assertEquals($comment->userId, 12);
                $this->assertEquals($comment->forename, "Onik");
                $this->assertEquals($comment->surname, "Noor");
                $this->assertEquals($comment->commentCreated, "2020-10-23 20:49:36");
            }
            else 
            {
                $this->fail("If Statement did work correctly! Check Condition");
            }
        }
    }

    /** @test */
    public function test_loadAssignee_checkContents()
    {
        $ticketController = new ticketController();
        $assignee = $ticketController->loadAssignee(83);
        $this->assertEquals($assignee[0]->forename, "Tufan");
        $this->assertEquals($assignee[0]->surname, "Butuner");
        $this->assertEquals($assignee[0]->username, "tufan");
        $this->assertEquals($assignee[0]->userId, 35);
    }

    public function test_loadAssignee_null()
    {
        $ticketController = new ticketController();
        $assignee = $ticketController->loadAssignee(null);
        $this->assertNull($assignee[0]);
    }
    
    
    public function test_loadReporter_checkContents()
    {
        $ticketController = new ticketController();
        $assignee = $ticketController->loadReporter(83);
        $this->assertEquals($assignee[0]->forename, "Onik");
        $this->assertEquals($assignee[0]->surname, "Noor");
        $this->assertEquals($assignee[0]->username, "od");
        $this->assertEquals($assignee[0]->userId, 12);
    }

    public function test_loadReporter_null()
    {
        $ticketController = new ticketController();
        $assignee = $ticketController->loadReporter(null);
        $this->assertNull($assignee[0]);
    }
}