<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class AdminController
{
    public function validateAdmin(?string $unitUserId)
    {
        $userId = $unitUserId == null ? unserialize($_SESSION['userLoggedIn'])->getId() : $unitUserId;
        
        if ($userId == null) return false;

        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT level FROM user WHERE userId = ?");
        $stmt->execute([$userId]);
        $level = $stmt->fetchColumn();

        return $level > 3 ? true : false;
    }

    public function activateUser($userId)
    {
        $adminController = new adminController();

        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE user SET isActive = 1 WHERE userId = ?");
        if ($adminController->validateAdmin(null) == true)
        {
            $stmt->execute([$userId]);
            return $stmt->fetchColumn();
        }
    }

    public function deactivateUser($userId)
    {
        $adminController = new adminController();

        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE user SET isActive = 0 WHERE userId = ?");
        if ($adminController->validateAdmin(null) == true)
        {
            $stmt->execute([$userId]);
            return $stmt->fetchColumn();
        }
    }

    public function getActiveUsers()
	{
        $adminController = new adminController();

		$pdo = Library::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT userId, forename, surname, username, level FROM user WHERE isActive = 1");
        if ($adminController->validateAdmin(null) == true)
        {
            $stmt->execute();
            $activeUsers = $stmt->fetchall();
            return $activeUsers;
        }
    }
    
    public function getInActiveUsers()
	{
        $adminController = new adminController();

		$pdo = Library::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT userId, forename, surname, username, level FROM user WHERE isActive = 0");
        if ($adminController->validateAdmin(null) == true)
        {
            $stmt->execute();
            $activeUsers = $stmt->fetchall();
            return $activeUsers;
        }
    }
    
    public function resetPassword($userId, ?string $unitTest)
    {
        $adminController = new adminController();

        $hashedPassword = $unitTest == null ? password_hash("password", PASSWORD_BCRYPT) : password_hash($unitTest, PASSWORD_BCRYPT);
        $pdo = Library::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE user SET password = ? WHERE userId = ?");
        if ($adminController->validateAdmin(null) == true)
        {
            $stmt->execute([$hashedPassword, $userId]);
            return true;
        }
        return false;
    }

    public function updateUserLevel($userId, $chosenUserLevel)
    {
        $adminController = new adminController();

        $pdo = Library::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE user SET level = ? WHERE userId = ?");
        if ($adminController->validateAdmin(null) == true)
        {
            $stmt->execute([$chosenUserLevel, $userId]);
            return true;
        }
        return false;
    }
}
?>