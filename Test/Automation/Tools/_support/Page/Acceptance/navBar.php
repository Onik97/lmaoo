<?php
namespace Page\Acceptance;

class navBar
{
    /**
     * @var \AcceptanceTester;
     */
    protected \AcceptanceTester $acceptanceTester;

    public $darkmodeToggle = "body > nav > div.custom-control.custom-switch";
    public $searchTextbox = "#searchBarInput";
    public $searchButton = "#searchBarBtn";
    public $homeLink = "#homeNav";
    public $loginDropdownItem = "#loginNav";
    public $registerDropdownItem = "#registerNav";
    public $projectDropdown = "#projectNav";
    public $accountDropdown = "#accountNav";
    public $managerDropdownItem = "#managerNav";
    public $editAccountDropdownItem = "#editAccountNav";
    public $logoutDropdownItem = "#logoutNav";
    public $adminDropdownItem = "#adminNav";

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

    public function toLoginPage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->loginDropdownItem);
    }

    public function toRegisterPage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->registerDropdownItem);
    }

    public function toManagerPage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->managerDropdownItem);
    }

    public function toAdminPage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->adminDropdownItem);
    }

    public function toProfilePage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->editAccountDropdownItem);
    }

    public function toLogoutPage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->logoutDropdownItem);
    }

    public function toggleDarkMode()
    {
        $this->acceptanceTester->click($this->darkmodeToggle);
    }

    public function searchTicket($ticketId)
    {
        $this->acceptanceTester->fillField($this->searchTextbox, $ticketId);
        $this->acceptanceTester->click($this->searchButton);
    }
}
