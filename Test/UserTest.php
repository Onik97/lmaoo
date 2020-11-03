<?php
require __DIR__ . "/../User/userController.php";

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_hasDup_true()
    {
        $userController = new userController();
        $actual = $userController->hasDup("od");
        $this->assertTrue($actual);
    }
    
    public function test_hasDup_false()
    {
        $userController = new userController();
        $actual = $userController->hasDup("ThisUserDoesNotExistAtAll");
        $this->assertFalse($actual);
    }

    public function test_hasDup_null()
    {
        $userController = new userController();
        $actual = $userController->hasDup(null);
        $this->assertFalse($actual);
    }

    public function test_userInfoById_checkContent()
    {
        $userController = new userController();
        $user = $userController->userInfoById(12);

        $this->assertEquals("Onik", $user->forename);
        $this->assertEquals("Noor", $user->surname);
        $this->assertEquals("od", $user->username);
    }
    
}