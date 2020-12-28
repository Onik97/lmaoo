<?php require(__DIR__ . '/userController.php');

$adminController = new adminController();

$function = $_POST['function'];

if ($function == "deactivateUser")
{
    $adminController->deactivateUser($_POST["userId"]);
}
else if ($function == "activateUser")
{
    $adminController->activateUser($_POST["userId"]);
}
else if ($function == "getAdminActiveUsers")
{
	echo json_encode($adminController->getActiveUsers());
}
else if ($function == "getAdminInActiveUsers")
{
	echo json_encode($adminController->getInActiveUsers());
}
else if ($function == "resetPassword")
{
    echo json_encode($adminController->resetPassword($_POST['userId'], null));
}
else if ($function == "updateUserLevel")
{
    ($adminController->updateUserLevel($_POST["userId"], ["chosenUserLevel"]));
}

class adminController
{
    public function validateAdmin(?string $unitUserId)
    {
        session_start();
        $userId = $unitUserId == null ? $_SESSION['userLoggedIn']->getId() : $unitUserId;
        
        if ($userId == null) return false;

        $pdo = logindb('user', 'pass');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT level FROM user WHERE userId = ?");
        $stmt->execute([$userId]);
        $level = $stmt->fetchColumn()['level'];

        return $level > 3 ? true : false;
    }

    public function activateUser($userId)
    {
        $adminController = new adminController();

        $pdo = logindb('user', 'pass');
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

        $pdo = logindb('user', 'pass');
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

		$pdo = logindb('user', 'pass');
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

		$pdo = logindb('user', 'pass');
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
        $pdo = logindb('user', 'pass');
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

        $pdo = logindb('user', 'pass');
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