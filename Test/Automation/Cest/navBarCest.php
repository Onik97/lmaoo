<?php

use Page\Acceptance\navBar;

class navBarCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }

    // tests
    public function navigateToLoginPage(AcceptanceTester $I, Page\Acceptance\navBar $n)    
    {
        $n->navigateToLoginPage();
        $uri = $I->grabFromCurrentUrl();
        $I->assertEquals($uri, "logi", "");
    }
}
