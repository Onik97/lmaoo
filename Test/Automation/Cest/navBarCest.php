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
        $l->login("od", "od");
        $I->wait(2);
        $n->toManagerPage();
        $url = $I->grabFromCurrentUrl();
        $I->assertEquals("/manager", $url);
    }
}
