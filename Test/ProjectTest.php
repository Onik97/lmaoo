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
        $_POST['function'] == "checkProjectExistance";
        $actual = $projectController->projectExistance("AutomationProject");
        $this->assertEquals(true, $actual);
    }

    public function test_projectExistance_false()
    {
        $projectController = new projectController();
        $_POST['function'] == "checkProjectExistance";
        $actual = $projectController->projectExistance("ThisProjectDoesNotExist");
        $this->assertEquals(false, $actual);
    }

    public function test_getProjectList_checkContents()
    {
        $projectController = new projectController();
        $list = $projectController->getProjectList();
        foreach ($list as $project) 
        {
            if($project->projectId == 26) //Automation Project has ID of 26
            {
                $this->assertEquals("AutomatidonProject", $project->name);
                $this->assertEquals("Back-log", $project->status);
            }
        }
    }

    public function test_getTicketListWithProgress_checkOpen()
    {
        $projectController = new projectController();
        $tickets = $projectController->getTicketListWithProgress(9, "Open");
        foreach ($tickets as $ticket)
        {
            if($ticket->ticketId == 83)
            {
                $this->assertEquals("AutomationOpenTicket", $ticket->summary);
                $this->assertEquals("Open", $ticket->progress);
                $this->assertEquals("Onik", $ticket->forename);
                $this->assertEquals("Noor", $ticket->surname);
            }

        }
    }

    public function test_getTicketListWithProgress_checkInProgress()
    {
        $projectController = new projectController();
        $tickets = $projectController->getTicketListWithProgress(9, "In Progress");
        foreach ($tickets as $ticket)
        {
            if($ticket->ticketId == 84)
            {
                $this->assertEquals("AutomationInProgressTicket", $ticket->summary);
                $this->assertEquals("In Progress", $ticket->progress);
                $this->assertEquals("Adil", $ticket->forename);
                $this->assertEquals("Rahman", $ticket->surname);
            }

        }
    }

    public function test_getTicketListWithProgress_checkInAutomation()
    {
        $projectController = new projectController();
        $tickets = $projectController->getTicketListWithProgress(9, "In Automation");
        foreach ($tickets as $ticket)
        {
            if($ticket->ticketId == 85)
            {
                $this->assertEquals("AutomationInAutomationProgress", $ticket->summary);
                $this->assertEquals("In Automation", $ticket->progress);
                $this->assertEquals("Unit", $ticket->forename);
                $this->assertEquals("Test", $ticket->surname);
            }
        }
    }
    
    public function test_getTicketListWithProgress_checkComplete()
    {
        $projectController = new projectController();
        $tickets = $projectController->getTicketListWithProgress(9, "Complete");
        foreach ($tickets as $ticket)
        {
            if($ticket->ticketId == 86)
            {
                $this->assertEquals("AutomationCompleteTicket", $ticket->summary);
                $this->assertEquals("Complete", $ticket->progress);
                $this->assertEquals("Owen", $ticket->forename);
                $this->assertEquals("Alister", $ticket->surname);
            }
        }
    }

    
}

?>