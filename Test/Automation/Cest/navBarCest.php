<?php

use Page\Acceptance\navBar;

class navBarCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }

    public function navigateToLoginPage(AcceptanceTester $I, Page\Acceptance\navBar $n)    
    {
        $n->toLoginPage();
        $url = $I->grabFromCurrentUrl();
        $I->assertEquals("/login", $url);
    }

    public function navigateToRegisterPage(AcceptanceTester $I, Page\Acceptance\navBar $n)    
    {
        $n->toRegisterPage();
        $url = $I->grabFromCurrentUrl();
        $I->assertEquals("/register", $url);
    }

    public function navigateToManagerPage(AcceptanceTester $I, Page\Acceptance\navBar $n, Page\Acceptance\Login $l)
    {
        $n->toLoginPage();
        $I->wait(0.5);
        $l->login("od", "od");
        $n->toManagerPage();
        $url = $I->grabFromCurrentUrl();
        $I->assertEquals("/manager", $url);
    }

    public function navigateToAdminPage(AcceptanceTester $I, Page\Acceptance\navBar $n, Page\Acceptance\Login $l)
    {
        $n->toLoginPage();
        $I->wait(0.5);
        $l->login("od", "od");
        $n->toAdminPage();
        $url = $I->grabFromCurrentUrl();
        $I->assertEquals("/admin", $url);
    }

    public function navigateToProfilePage(AcceptanceTester $I, Page\Acceptance\navBar $n, Page\Acceptance\Login $l)
    {
        $n->toLoginPage();
        $I->wait(0.5);
        $l->login("od", "od");
        $n->toProfilePage();
        $url = $I->grabFromCurrentUrl();
        $I->assertEquals("/profile", $url);
    }

    public function navigateToLogoutPage(AcceptanceTester $I, Page\Acceptance\navBar $n, Page\Acceptance\Login $l)
    {
        $n->toLoginPage();
        $I->wait(0.5);
        $l->login("od", "od");
        $n->toLogoutPage();
        $url = $I->grabFromCurrentUrl();
        $I->assertEquals("/", $url);
    }
}