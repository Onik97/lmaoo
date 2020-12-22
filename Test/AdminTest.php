<?php
require __DIR__ . "/../User/adminController.php";
require __DIR__ . "/../User/userController.php";
use PHPUnit\Framework\TestCase;

class AdminTest extends TestCase
{
    public function test_validateAdmin_true()
    {
        $adminController = new adminController();
        $actual = $adminController->validateAdmin(12);
        $this->assertTrue($actual);
    }

    public function test_validateAdmin_false()
    {
        $adminController = new adminController();
        $actual = $adminController->validateAdmin(34);
        $this->assertFalse($actual);
    }

    public function test_validateAdmin_trueWithSession()
    {
        session_start();
        $_SESSION['userLoggedIn'] = new user(12, null, null, null, null, null, null, null);
        $adminController = new adminController();
        $actual = $adminController->validateAdmin(null);
        $this->assertTrue($actual);
        session_destroy();
    }

    public function test_validateAdmin_falseWithSession()
    {
        session_start();
        $_SESSION['userLoggedIn'] = new user(34, null, null, null, null, null, null, null);
        $adminController = new adminController();
        $actual = $adminController->validateAdmin(null);
        $this->assertFalse($actual);
        session_destroy();
    }

    public function test_activateUser_activateUser()
    {
        $adminController = new adminController();
        $userController = new userController();

        session_start();
        $_SESSION['userLoggedIn'] = new user(12, null, null, null, null, null, null, null);  
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
        $adminController = new adminController();
        $userController = new userController();

        session_start();
        $_SESSION['userLoggedIn'] = new user(12, null, null, null, null, null, null, null);  
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
        $adminController = new adminController();
        $userController = new userController();

        session_start();
        $_SESSION['userLoggedIn'] = new user(12, null, null, null, null, null, null, null);  
        $adminController->resetPassword(34, null);
        $userUpdated = $userController->userInfoById(34);
        $this->assertTrue(password_verify("password", $userUpdated->password));
        session_destroy();
    }

    public function test_resetPassword_resetBack()
    {
        $hashedPassword = '$2y$10$gynAasS6oo8n3u6cR9XaF.hKLPrHiSb1xvcSSa3K//XoVWczvLywS'; // Password: test
        $adminController = new adminController();
        $userController = new userController();

        session_start();
        $_SESSION['userLoggedIn'] = new user(12, null, null, null, null, null, null, null);  
        $adminController->resetPassword(34, null);
        $userUpdated = $userController->userInfoById(34);
        $adminController->resetPassword(34, $hashedPassword);
        $this->assertFalse(password_verify("test", $userUpdated->password));
        session_destroy();
    }
}

?>