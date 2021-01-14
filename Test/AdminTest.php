<?php include_once "autoload.php";

use PHPUnit\Framework\TestCase;

class AdminTest extends TestCase
{
    public function test_validateAdmin_true()
    {
        $adminController = new AdminController();
        $actual = $adminController->validateAdmin(12);
        $this->assertTrue($actual);
    }

    public function test_validateAdmin_false()
    {
        $adminController = new AdminController();
        $actual = $adminController->validateAdmin(34);
        $this->assertFalse($actual);
    }

    public function test_validateAdmin_trueWithSession()
    {
        $user = new user(12, null, null, null, null, null, null, null, null);
        $_SESSION['userLoggedIn'] = serialize($user);
        $adminController = new AdminController();
        $actual = $adminController->validateAdmin(null);
        $this->assertTrue($actual);
        session_destroy();
    }

    public function test_validateAdmin_falseWithSession()
    {
        $user = new user(34, null, null, null, null, null, null, null, null);
        $_SESSION['userLoggedIn'] = serialize($user);
        $adminController = new AdminController();
        $actual = $adminController->validateAdmin(null);
        $this->assertFalse($actual);
        session_destroy();
    }

    public function test_activateUser_activateUser()
    {
        $adminController = new AdminController();
        $userController = new UserController();

        $user = new user(12, null, null, null, null, null, null, null, null);
        $_SESSION['userLoggedIn'] = serialize($user);
        $adminController->activateUser(34);
        $userUpdated = $userController->userInfoById(34);

        $this->assertEquals(34, $userUpdated->userId);
        $this->assertEquals("deactivated", $userUpdated->username);
        $this->assertEquals("Unit", $userUpdated->forename);
        $this->assertEquals("Test", $userUpdated->surname);
        $this->assertEquals(1, $userUpdated->isActive);
        session_destroy();
    }

    public function test_activateUser_deactivateUser()
    {
        $adminController = new AdminController();
        $userController = new UserController();

        $user = new user(12, null, null, null, null, null, null, null, null);
        $_SESSION['userLoggedIn'] = serialize($user);
        $adminController->deactivateUser(34);
        $userUpdated = $userController->userInfoById(34);

        $this->assertEquals(34, $userUpdated->userId);
        $this->assertEquals("deactivated", $userUpdated->username);
        $this->assertEquals("Unit", $userUpdated->forename);
        $this->assertEquals("Test", $userUpdated->surname);
        $this->assertEquals(0, $userUpdated->isActive);
        session_destroy();
    }

    public function test_resetPassword_reset()
    {
        $adminController = new AdminController();
        $userController = new UserController();

        $user = new user(12, null, null, null, null, null, null, null, null);
        $_SESSION['userLoggedIn'] = serialize($user);
        $adminController->resetPassword(34, null);
        $userUpdated = $userController->userInfoById(34);
        $this->assertTrue(password_verify("password", $userUpdated->password));
        session_destroy();
    }

    public function test_resetPassword_resetBack()
    {
        $hashedPassword = '$2y$10$gynAasS6oo8n3u6cR9XaF.hKLPrHiSb1xvcSSa3K//XoVWczvLywS'; // Password: test
        $adminController = new AdminController();
        $userController = new UserController();

        $user = new user(12, null, null, null, null, null, null, null, null);
        $_SESSION['userLoggedIn'] = serialize($user);
        $adminController->resetPassword(34, null);
        $userUpdated = $userController->userInfoById(34);
        $adminController->resetPassword(34, $hashedPassword);
        $this->assertFalse(password_verify("test", $userUpdated->password));
        session_destroy();
    }

    public function test_updateUserLevel_setToFour()
    {
        $user = new user(12, null, null, null, null, null, null, null, null);
        $_SESSION['userLoggedIn'] = serialize($user);

        $adminController = new AdminController();
        $adminController->updateUserLevel(46, 4);
        $userController = new UserController();
        $expected = $userController->userInfoById(46);

        $this->assertEquals($expected->level, 4);
    }

    public function test_updateUserLevel_setToOne()
    {
        $user = new user(12, null, null, null, null, null, null, null, null);
        $_SESSION['userLoggedIn'] = serialize($user);

        $adminController = new AdminController();
        $adminController->updateUserLevel(46, 1);
        $userController = new UserController();
        $expected = $userController->userInfoById(46);

        $this->assertEquals($expected->level, 1);
    }

    public function test_updateUserLevel_setToTwo()
    {
        $user = new user(12, null, null, null, null, null, null, null, null);
        $_SESSION['userLoggedIn'] = serialize($user);

        $adminController = new AdminController();
        $adminController->updateUserLevel(46, 2);
        $userController = new UserController();
        $expected = $userController->userInfoById(46);

        $this->assertEquals($expected->level, 2);
    }

    public function test_updateUserLevel_setToThree()
    {
        $user = new user(12, null, null, null, null, null, null, null, null);
        $_SESSION['userLoggedIn'] = serialize($user);

        $adminController = new AdminController();
        $adminController->updateUserLevel(46, 3);
        $userController = new UserController();
        $expected = $userController->userInfoById(46);

        $this->assertEquals($expected->level, 3);
    }
}

?>