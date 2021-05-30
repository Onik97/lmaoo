<?php

class LoginSteps
{
  protected $I;

  function __construct(AcceptanceTester $I)
  {
      $this->I = $I;
  }

     /**
     * @Given I go to the Login Page
     */
    public function iGoToTheLoginPage()
    {
        $this->I->amOnPage('/login');
    }
}