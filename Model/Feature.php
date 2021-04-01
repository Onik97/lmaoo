<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class Feature extends Database
{
    public function getActiveFeature($projectId)
    {
        $sql = "SELECT * FROM feature WHERE projectId = ? AND active = 1";
        return self::db()::query($sql)->parameters([$projectId])->fetchAll();
    }

    public function getInactiveFeature($projectId)
    {
        $sql = "SELECT * FROM feature WHERE projectId = ? AND active = 0";
        return self::db()::query($sql)->parameters([$projectId])->fetchAll();
    }

    public function activateFeature($featureId)
    {
        $sql = "UPDATE feature SET active = 1 WHERE featureId = ?";
        return self::db()::query($sql)->parameters([$featureId])->fetchAll();
    }

    public function deactivateFeature($featureId)
    {
        $sql = "UPDATE feature SET active = 0 WHERE featureId = ?";
        return self::db()::query($sql)->parameters([$featureId])->fetchAll();
    }

    public function doesFeatureExists($featureName, $projectId)
    {
        $sql = "SELECT name FROM feature WHERE name = ? AND projectId = ?";
        return self::db()::query($sql)->parameters([$featureName, $projectId])->rowCount()
        ? true : false;
    }

    public function createFeature($featureName, $projectId)
    {
        $sql = "INSERT INTO feature (name, projectId) VALUES (?, ?)";
        self::db()::query($sql)->parameters([$featureName, $projectId])->exec();
    }
}