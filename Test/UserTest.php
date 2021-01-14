<?php require_once "autoload.php";

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_hasDup_true()
    {
        $userController = new UserController();
        $actual = $userController->hasDup("od");
        $this->assertTrue($actual);
    }

    public function test_hasDup_false()
    {
        $userController = new UserController();
        $actual = $userController->hasDup("ThisUserDoesNotExistAtAll");
        $this->assertFalse($actual);
    }

    public function test_hasDup_null()
    {
        $userController = new UserController();
        $actual = $userController->hasDup(null);
        $this->assertFalse($actual);
    }

    public function test_userInfoById_checkContent()
    {
        $userController = new UserController();
        $user = $userController->userInfoById(12);

        $this->assertEquals("Onik", $user->forename);
        $this->assertEquals("Noor", $user->surname);
        $this->assertEquals("od", $user->username);
    }

    public function test_updatePicture_change()
    {
        $userController = new UserController();
        $userController->updatePicture("Testing this Target", 46);
        $user = $userController->userInfoById(46);

        $this->assertEquals("Testing this Target", $user->picture);
    }

    public function test_updatePicture_changeBack()
    {
        $userController = new UserController();
        $userController->updatePicture("../Images/profilePictures/avatar.jpg", 46);
        $user = $userController->userInfoById(46);

        $this->assertEquals("../Images/profilePictures/avatar.jpg", $user->picture);
    }

    public function test_darkModeToggle_true()
    {
        $userController = new UserController();
        $userController->darkModeToggle(1, 46);
        $actual = $userController->loadDarkMode(46);

        $this->assertEquals(1, $actual);
    }

    public function test_darkModeToggle_false()
    {
        $userController = new UserController();
        $userController->darkModeToggle(0, 46);
        $actual = $userController->loadDarkMode(46);

        $this->assertEquals(0, $actual);
    }
}
