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
        $uri = $I->grabFromCurrentUrl();
        $I->assertEquals($uri, "/login");
    }
}
