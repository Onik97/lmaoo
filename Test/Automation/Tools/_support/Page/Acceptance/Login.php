<?php
namespace Page\Acceptance;

class Login
{
    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;
    
    public $loginTextbox = "#usernameLogin";
    public $passwordTextbox = "#passwordLogin";
    public $loginButton = "body > main > div > div > div > div.col-md-6.text-center > div > form > button";
    public $registerHyperlink = "body > main > div > div > div > div.col-md-6.text-center > div > form > div.form-group.mt-3 > a";

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

    public function login($username, $password)
    {
        $this->acceptanceTester->fillField($this->loginTextbox, $username);
        $this->acceptanceTester->fillField($this->passwordTextbox, $password);
        $this->acceptanceTester->click($this->loginButton);
    }
}
