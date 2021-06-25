<?php

use Page\Acceptance\Login;

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
        // $this->l = new Login($I);
        $I->amOnPage('/login');
    }

    public function LoginSuccess(AcceptanceTester $I, Page\Acceptance\Login $l)
    {
        $l->login("automation", "test");
        $I->see("Welcome back User");
    }

    public function LoginFailed(AcceptanceTester $I, Page\Acceptance\Login $l)
    {
        $l->login("fhdfjdhfjg", "fjgkjdhgdk");
        $I->see("Username and Password did not match");
    }

    public function LoginInactive(AcceptanceTester $I, Page\Acceptance\Login $l)
    {
        $l->login("deactivated", "test");
        $I->see("User deactivated, contact the administrator");
    }
}