<?php 
require __DIR__ . "/../Project/projectController.php";

use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{

    public function test_projectExistance_null()
    {
        $projectController = new projectController();
        $actual = $projectController->projectExistance(null);
        $this->assertEquals(null, $actual);
    }

    public function test_projectExistance_true()
    {
        $projectController = new projectController();
        $actual = $projectController->projectExistance("AutomationProject");
        $this->assertTrue($actual);
    }

    public function test_projectExistance_false()
    {
        $projectController = new projectController();
        $actual = $projectController->projectExistance("ThisProjectDoesNotExist");
        $this->assertFalse($actual);
    }

    public function test_getProjectList_checkContents()
    {
        $projectController = new projectController();
        $list = $projectController->getProjectList();
        foreach ($list as $projectFromDB) 
        {
            if($projectFromDB->projectId == 26) $project = $projectFromDB;
        }
        
        $this->assertEquals("AutomationProject", $project->name);
        $this->assertEquals("Back-log", $project->status);  
    }

    public function test_getTicketListWithProgress_checkOpen()
    {
        $projectController = new projectController();
        $tickets = $projectController->getTicketListWithProgress(9, "Open");
        foreach ($tickets as $ticketFromDB)
        {
            if($ticketFromDB->ticketId == 83) $ticket = $ticketFromDB;
        }

        $this->assertEquals("AutomationOpenTicket", $ticket->summary);
        $this->assertEquals("Open", $ticket->progress);
        $this->assertEquals("Tufan", $ticket->forename);
        $this->assertEquals("Butuner", $ticket->surname);
    }

    public function test_getTicketListWithProgress_checkInProgress()
    {
        $projectController = new projectController();
        $tickets = $projectController->getTicketListWithProgress(9, "In Progress");
        foreach ($tickets as $ticketFromDB)
        {
            if($ticketFromDB->ticketId == 84) $ticket = $ticketFromDB;
            if($ticketFromDB->ticketId == 85) $ticket2 = $ticketFromDB;
        }
            
        $this->assertEquals("AutomationInProgressTicket", $ticket->summary);
        $this->assertEquals("In Progress", $ticket->progress);
        $this->assertEquals("Adil", $ticket->forename);
        $this->assertEquals("Rahman", $ticket->surname);

        $this->assertEquals("AutomationInAutomationProgress", $ticket2->summary);
        $this->assertEquals("In Automation", $ticket2->progress);
        $this->assertEquals("Unit", $ticket2->forename);
        $this->assertEquals("Test", $ticket2->surname);
    }

    public function test_getTicketListWithProgress_checkComplete()
    {
        $projectController = new projectController();
        $tickets = $projectController->getTicketListWithProgress(9, "Complete");
        foreach ($tickets as $ticketFromDB)
        {
            if($ticketFromDB->ticketId == 86) $ticket = $ticketFromDB;
        }

        $this->assertEquals("AutomationCompleteTicket", $ticket->summary);
        $this->assertEquals("Complete", $ticket->progress);
        $this->assertEquals("Owen", $ticket->forename);
        $this->assertEquals("Alister", $ticket->surname);
    }
}
?>