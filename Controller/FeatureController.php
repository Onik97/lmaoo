<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php");

class FeatureController
{
    public function loadFeatures($projectId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT * FROM feature WHERE projectId = ?");
        $stmt->execute([$projectId]);
        return $stmt->fetchAll();
    }

    public function featureExistance($featureName, $projectId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("SELECT name FROM feature WHERE name = ? AND projectId = ?");
        $stmt->execute([$featureName, $projectId]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public function createFeature($featureName, $projectId)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("INSERT INTO feature (name, projectId) VALUES (?, ?)");
        $stmt->execute([$featureName, $projectId]);
    }
}

?>