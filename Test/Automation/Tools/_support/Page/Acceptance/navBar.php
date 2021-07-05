<?php
namespace Page\Acceptance;

class navBar
{
    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

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

    public function navigateToLoginPage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->loginDropdownItem);
    }

    public function navigateToRegisterPage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->registerDropdownItem);
    }

    public function navigateToManagerPage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->managerDropdownItem);
    }

    public function navigateToAdminPage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->adminDropdownItem);
    }

    public function navigateToProfilePage()
    {
        $this->acceptanceTester->click($this->accountDropdown);
        $this->acceptanceTester->click($this->profileDropdownItem);
    }

    public function navigateToLogoutPage()
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
