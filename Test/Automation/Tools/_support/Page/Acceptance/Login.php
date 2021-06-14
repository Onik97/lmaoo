<?php
namespace Page\Acceptance;

class Login
{
    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;
    // Selectors here -> Also remove this comment

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

}
