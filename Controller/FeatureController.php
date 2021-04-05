<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class FeatureController
{
    public static function loadActiveFeatures($projectId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT * FROM feature WHERE projectId = ? AND active = 1");
        $stmt->execute([$projectId]);
        return $stmt->fetchAll();
    }

    public static function loadInactiveFeatures($projectId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT * FROM feature WHERE projectId = ? AND active = 0");
        $stmt->execute([$projectId]);
        return $stmt->fetchAll();
    }

    public static function activateFeature($featureId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE feature SET active = 1 WHERE featureId = ?");
        $stmt->execute([$featureId]);
        return $stmt->fetchAll();
    }

    public static function deactivateFeature($featureId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE feature SET active = 0 WHERE featureId = ?");
        $stmt->execute([$featureId]);
        return $stmt->fetchAll();
    }

    public static function featureExistance($featureName, $projectId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT name FROM feature WHERE name = ? AND projectId = ?");
        $stmt->execute([$featureName, $projectId]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public static function createFeature($featureName, $projectId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("INSERT INTO feature (name, projectId) VALUES (?, ?)");
        $stmt->execute([$featureName, $projectId]);
    }
}
