<?php require_once "autoload.php";

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

    public function test_updatePicture_change()
    {
        $userController = new userController();
        $userController->updatePicture("Testing this Target", 46);
        $user = $userController->userInfoById(46);

        $this->assertEquals("Testing this Target", $user->picture);
    }

    public function test_updatePicture_changeBack()
    {
        $userController = new userController();
        $userController->updatePicture("../Images/profilePictures/avatar.jpg", 46);
        $user = $userController->userInfoById(46);

        $this->assertEquals("../Images/profilePictures/avatar.jpg", $user->picture);
    }

    public function test_darkModeToggle_true()
    {
        $userController = new userController();
        $userController->darkModeToggle(1, 46);
        $actual = $userController->loadDarkMode(46);

        $this->assertEquals(1, $actual);
    }

    public function test_darkModeToggle_false()
    {
        $userController = new userController();
        $userController->darkModeToggle(0, 46);
        $actual = $userController->loadDarkMode(46);

        $this->assertEquals(0, $actual);
    }
}
